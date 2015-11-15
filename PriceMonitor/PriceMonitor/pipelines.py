# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/topics/item-pipeline.html

from scrapy.exceptions import DropItem
class PriceMonitorPipeline(object):
    def process_item(self, item, spider):
        if not item['name']:
            raise DropItem("Has no description")
        if not item['price']:
            raise DropItem("Has no price set")
        if not item['currency']:
            raise DropItem("Has no currency set")
        return item

import MySQLdb
import json
from datetime import datetime, timedelta
# @see https://github.com/rolando/dirbot-mysql/blob/master/dirbot/pipelines.py
# @see http://stackoverflow.com/a/22853435/11301
class StoragePipeline(object):
    @classmethod
    def from_crawler(pipeline, crawler):
        return pipeline(crawler.settings)
    
    def __init__(self, settings):
        self.settings = settings
        self.conn = MySQLdb.connect(user=self.settings['DB_USER'], passwd=self.settings['DB_PASS'], db=self.settings['DB_NAME'], host=self.settings['DB_HOST'], charset="utf8", use_unicode=True)
        self.cursor = self.conn.cursor()
        self.run_id = str(datetime.now())
        
    def process_item(self, item, spider):
        now = datetime.utcnow().replace(microsecond=0).isoformat(' ')
        last_item = self.item_last_values(item, spider)
        item_is_new = True
        if last_item and abs(last_item['price']-item['price'])<0.01 and last_item['currency']==item['currency']:
            item_is_new = False
        
        if item_is_new:
            self.cursor.execute("""INSERT INTO `quamis_pricemonitor_product_logs` (`id`, `run_id`, `name`, `price`, `currency`, `description`, `extractedData`, `created_at`, `updated_at` ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)""", 
                (
                    item['id'].encode('utf-8'), 
                    self.run_id.encode('utf-8'),
                    item['name'].encode('utf-8'),
                    item['price'],
                    item['currency'].encode('utf-8'),
                    item['description'].encode('utf-8'),
                    json.dumps(item['extractedData'], ensure_ascii=False).encode('utf-8'),
                    now.encode('utf-8'),
                    now.encode('utf-8'),
                )
            )
            
            for (key, value) in item['attributes'].items():
                if value is not None:
                    self.cursor.execute("""REPLACE INTO `quamis_pricemonitor_product_attributes` (`id`, `key`, `value`, `created_at`, `updated_at` ) VALUES (%s, %s, %s, %s, %s)""", 
                        (
                            ("%s.%s"%(item['id'], key)).encode('utf-8'), 
                            key.encode('utf-8'),
                            value.encode('utf-8'),
                            now.encode('utf-8'),
                            now.encode('utf-8'),
                        )
                    )
                
            spider.log("INSERT: [%s] %s" % (item['id'], item['URL']))
            
        else:
            self.cursor.execute("""UPDATE `quamis_pricemonitor_product_logs` SET `updated_at`=%s, `run_id`=%s WHERE `id`=%s AND `price`=%s AND `currency`=%s AND `created_at`=%s""", 
                (
                    now.encode('utf-8'),
                    self.run_id.encode('utf-8'),
                    item['id'].encode('utf-8'), 
                    item['price'],
                    item['currency'].encode('utf-8'),                     
                    last_item['created_at'].isoformat(' ').encode('utf-8'),
                )
            )
            
            spider.log("UPDATE: [%s] %s" % (item['id'], item['URL']))
        
        if spider.getArg('update_missing_attributes'):
            for (key, value) in item['attributes'].items():
                #if value is None:
                #    self.cursor.execute("""DELETE FROM `quamis_pricemonitor_product_attributes` WHERE `id`=%s AND `key`=%s""", 
                #        (
                #            ("%s.%s"%(item['id'], key)).encode('utf-8'), 
                #            key.encode('utf-8'),
                #        )
                #    )
                #else:
                if value is not None:
                    self.cursor.execute("""REPLACE INTO `quamis_pricemonitor_product_attributes` (`id`, `key`, `value`, `created_at`, `updated_at` ) VALUES (%s, %s, %s, %s, %s)""", 
                        (
                            ("%s.%s"%(item['id'], key)).encode('utf-8'), 
                            key.encode('utf-8'),
                            value.encode('utf-8'),
                            now.encode('utf-8'),
                            now.encode('utf-8'),
                        )
                    )
        
        self.conn.commit()
        return item
        
    def item_last_values(self, item, spider):
        self.cursor.execute("""SELECT `id`, `run_id`, `name`, `price`, `currency`, `description`, `extractedData`, `created_at`, `updated_at` FROM `quamis_pricemonitor_product_logs` WHERE `id`=%s ORDER BY `updated_at` DESC LIMIT 1""", 
            (
                item['id'].encode('utf-8'), 
            )
        )
        row = self.cursor.fetchone()
        if not row:
            return False

        columns = ("id", "run_id", "name", "price", "currency", "description", "extractedData", "created_at", "updated_at",)
        return dict(zip(columns, row))
    
    def close_spider(self, spider):
        maxDate = (datetime.utcnow() - timedelta(days=5)).replace(microsecond=0).isoformat(' ')
        self.cursor.execute("""
            UPDATE `quamis_pricemonitor_product` 
                SET `active`=0 
            WHERE
                `spider`=%s
                AND `active`
                AND `id` IN (SELECT DISTINCT `id` FROM `quamis_pricemonitor_product_logs`)
                AND `id` NOT IN (SELECT DISTINCT `id` FROM `quamis_pricemonitor_product_logs` WHERE `updated_at`>%s)
            """, 
            (
                (spider.name).encode('utf-8'),
                maxDate,
            )
        )
        
        self.conn.commit()
