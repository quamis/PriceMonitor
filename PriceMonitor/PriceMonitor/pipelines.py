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
from datetime import datetime
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
            self.cursor.execute("""INSERT INTO `products` (`id`, `URL`, `name`, `price`, `currency`, `details`, `addTime`, `lastSeen`, `spider`, `run_id`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""", 
                (
                    item['id'].encode('utf-8'), 
                    item['URL'].encode('utf-8'),
                    item['name'].encode('utf-8'),
                    item['price'],
                    item['currency'].encode('utf-8'),
                    item['details'].encode('utf-8'),
                    now.encode('utf-8'),
                    now.encode('utf-8'),
                    spider.name,
                    self.run_id.encode('utf-8'),
                )
            )
            spider.log("INSERT: [%s] %s" % (item['id'], item['URL']))
            
        else:
            self.cursor.execute("""UPDATE `products` SET `lastSeen`=%s, `run_id`=%s WHERE `id`=%s AND spider=%s AND `price`=%s AND `currency`=%s AND `addTime`=%s""", 
                (
                    now.encode('utf-8'),
                    self.run_id.encode('utf-8'),
                    item['id'].encode('utf-8'), 
                    spider.name,
                    item['price'],
                    item['currency'].encode('utf-8'),                     
                    last_item['addTime'].isoformat(' ').encode('utf-8'),
                )
            )
            spider.log("UPDATE: [%s] %s" % (item['id'], item['URL']))

        self.conn.commit()
        return item
        
    def item_last_values(self, item, spider):
        self.cursor.execute("""SELECT `id`, `URL`, `name`, `price`, `currency`, `details`, `addTime`, `lastSeen`, `spider` FROM `products` WHERE `id`=%s AND `spider`=%s ORDER BY `lastSeen` DESC LIMIT 1""", 
            (
                item['id'].encode('utf-8'), 
                spider.name,
            )
        )
        row = self.cursor.fetchone()
        if not row:
            return False
        columns = ("id", "URL", "name", "price", "currency", "details", "addTime", "lastSeen", "spider")
        return dict(zip(columns, row))
    
