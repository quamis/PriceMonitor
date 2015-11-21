import scrapy
from scrapy.spider import BaseSpider
import MySQLdb
import hashlib
import re

from scrapy import log

""" 
supported params: 
    update_type=new
    update_type=all
    update_type=id~123,124,125,126
    update_type=update-missing-attributes
"""
class BaseSpider(BaseSpider):
    # INSERT INTO `urls` (`addTime`, `spider`, `url`) VALUES (NOW(), 'emag.ro', 'http://www.emag.ro/televizor-led-horizon-81-cm-hd-32hl730h/pd/DGWNYMBBM/');
    conn = None
    idUrlAssoc = {}
    args = {}
    
    def __init__(self, run_id=None, update_type=None):
        self.args['run_id'] = run_id
        self.args['update_type'] = update_type
        self.args['update_missing_attributes'] = False
        
    def getArg(self, attr):
        return attr in self.args and self.args[attr]
    
    def start_requests(self):
        self.conn = MySQLdb.connect(user=self.settings['DB_USER'], passwd=self.settings['DB_PASS'], db=self.settings['DB_NAME'], host=self.settings['DB_HOST'], charset="utf8", use_unicode=True)
        self.cursor = self.conn.cursor()

        if self.args['update_type'] and self.args['update_type']=='new':
            self.cursor.execute("""SELECT `id`, `url` FROM `quamis_pricemonitor_product` WHERE `spider`=%s AND `active` AND `id` NOT IN (SELECT DISTINCT `id` FROM `quamis_pricemonitor_product_logs`) ORDER BY RAND() ASC""", (self.name,))
            rows = self.cursor.fetchall()
        elif self.args['update_type'] and re.match("^id~", self.args['update_type']):
            ids = []
            
            matches = re.match("^id~(.+)", self.args['update_type'])
            if matches:
                for id in matches.group(1).split(","):
                    ids.append(id)
            
                format_strings = ','.join(['%s'] * len(ids))
                params = ids
                params.insert(0, self.name)
                self.cursor.execute("""SELECT `id`, `url` FROM `quamis_pricemonitor_product` WHERE `spider`=%s AND `active` AND `id` IN ("""+format_strings+""") ORDER BY RAND() ASC""", params)
                rows = self.cursor.fetchall()
            else:
                rows = []
        elif self.args['update_type'] and self.args['update_type']=='all':
            self.cursor.execute("""SELECT `id`, `url` FROM `quamis_pricemonitor_product` WHERE `spider`=%s AND `active` ORDER BY RAND() ASC""", (self.name,))
            rows = self.cursor.fetchall()
        elif self.args['update_type'] and self.args['update_type']=='update-missing-attributes':
            self.cursor.execute("""SELECT prod.`id`, prod.`url` 
                FROM `quamis_pricemonitor_product` AS prod 
                WHERE 
                    prod.`spider`=%s
                    AND prod.`active` 
                    AND prod.`id` NOT IN (SELECT DISTINCT REPLACE(`id`, CONCAT('.', attr.key), '') AS id FROM `quamis_pricemonitor_product_attributes` AS attr WHERE attr.key='category')
                ORDER BY RAND() ASC
            """, (self.name,))
            rows = self.cursor.fetchall()
            self.args['update_missing_attributes'] = True
        else:
            raise ValueError("update_type wasn't specified");

        for [id, url] in rows:
            self.idUrlAssoc[url] = id
            yield scrapy.http.Request(url, self.parse)
    
    
    def get_id(self, response):
        urls = [response.url]
        if 'redirect_urls' in response.meta:
            log.msg("  %s got redirected to" % response.url, level=log.DEBUG)
            for (url) in response.meta['redirect_urls']:
                log.msg("    |--> %s" % url, level=log.DEBUG)
                urls.insert(0, url)
        
        
        for (url) in urls:
            if url in self.idUrlAssoc:
                return self.idUrlAssoc[url]
        
        raise ValueError("Trying to build an ID for an element not in the database. Url: %s" % response.url)
        # return "%s.%03d.%s" % (hashlib.md5(self.name.lower()).hexdigest()[0:4], len(response.url.lower()), hashlib.md5(response.url.lower()).hexdigest())
        
    
    def determineAttributes(self, name):
        attributes = {}
        attributes['category'] = None
        attributes['quantity'] = None
        attributes['quantity_UM'] = None
        
        attributes['category'] =     self.determineCategory(name)
        
        # determine quantity
        qty = None
        if attributes['category']=='pampers':
            qty =     self.determineQuantity_pampers(name, attributes['category'])
        if attributes['category']=='hdd:ssd':
            qty =     self.determineQuantity_hdd(name, attributes['category'])
        if attributes['category']=='hdd':
            qty =     self.determineQuantity_hdd(name, attributes['category'])
        if attributes['category']=='tv':
            qty = self.determineQuantity_tv(name, attributes['category'])
            
        if qty is not None:
            attributes['quantity'] =     str(qty)
        
        # determine quantity_UM
        if attributes['category']=='pampers' and 'quantity' in attributes and attributes['quantity'] is not None:
            attributes['quantity_UM'] = 'pcs'
        if attributes['category']=='hdd:ssd' and 'quantity' in attributes and attributes['quantity'] is not None:
            attributes['quantity_UM'] = 'GB'
        if attributes['category']=='hdd' and 'quantity' in attributes and attributes['quantity'] is not None:
            attributes['quantity_UM'] = 'GB'
        if attributes['category']=='tv' and 'quantity' in attributes and attributes['quantity'] is not None:
            attributes['quantity_UM'] = 'cm'
        
        return attributes
    
    def determineCategory(self, name):
        ret = None
        if ret is None and re.search("(Scutece Pampers)", name, re.IGNORECASE) is not None:
            ret = "pampers"
        
        if ret is None and re.search("((^|\s)(SSD|Solid(-|\s)State)(\s|\)|$))", name, re.IGNORECASE) is not None:
            ret = "hdd:ssd"
        if ret is None and re.search("(\(SSD\))", name, re.IGNORECASE) is not None:
            ret = "hdd:ssd"
            
        if ret is None and re.search("((^|\s)(HDD|Hard(-|\s)disk)(\s|\)|$))", name, re.IGNORECASE) is not None:
            ret = "hdd"
        
        if ret is None and re.search("(Cuptor cu microunde)", name, re.IGNORECASE) is not None:
            ret = "kitchen:microwave"     
            
        if ret is None and re.search("(^|\s)(Stabilizator de tensiune)(\s|$)", name, re.IGNORECASE) is not None:
            ret = "kitchen:stabilizer"        
        if ret is None and re.search("(^|\s)(AVR nJoy)(\s|$)", name, re.IGNORECASE) is not None:
            ret = "kitchen:stabilizer"        
            
        if ret is None and re.search("(Scaun auto)", name, re.IGNORECASE) is not None:
            ret = "car:babyCarSeat"
            
        if ret is None and re.search("(^|\s)(Anvelopa)(\s|$)", name, re.IGNORECASE) is not None:
            ret = "car:tires"
        if ret is None and re.search("(^|\s)(Anvelope)(\s|$)", name, re.IGNORECASE) is not None:
            ret = "car:tires"
        
        if ret is None and re.search("(^|\s)(Telefon|Smartphone|Phone)(\s|$)", name, re.IGNORECASE) is not None:
            ret = "phone"
            
        if ret is None and re.search("(^|\s)(Laptop)(\s|$)", name, re.IGNORECASE) is not None:
            ret = "laptop"
        
        
        
            
        if ret is None and re.search("(Televizor LED|Smart TV|Televizor Smart|Televizor LED Smart|Televizor|TV LED)", name, re.IGNORECASE) is not None:
            ret = "tv"
        
        return ret
        
    def determineQuantity_pampers(self, name, category):
        ret = None
        m = re.search("(?P<pcs>[0-9]+)[\s]*buc", name, re.IGNORECASE)
        if m:
            ret = int(m.group('pcs'))
        
        return ret
        
    def determineQuantity_hdd(self, name, category):
        ret = None
        m = re.search("(?P<pcs>[0-9]+)[\s]*(?P<UM>TB|GB|MB)", name, re.IGNORECASE)
        if m:
            pcs = int(m.group('pcs'))
            
            if m.group('UM').upper()=='TB':
                ret = pcs*1000
            if m.group('UM').upper()=='GB':
                ret = pcs
        
        return ret
        
    def determineQuantity_tv(self, name, category):
        ret = None
        m = re.search("(?P<pcs>[0-9]+)[\s]*cm", name, re.IGNORECASE)
        if m:
            ret = int(m.group('pcs'))
        
        m = re.search("LED (?P<pcs>(32|31|30))[\s]", name, re.IGNORECASE)
        if m:
            ret = int(round(int(m.group('pcs'))*2.54))
            
        m = re.search("[\s](?P<pcs>(32|31|30))[\s]", name, re.IGNORECASE)
        if m:
            ret = int(round(int(m.group('pcs'))*2.54))
        
        return ret
        
    def extractPrice(self, fmt, text):
        if fmt=="fmt:human:RO,dirty":   # "pret: 1.234,56 RON  "
            return float(re.sub("[^0-9\.]", "", re.sub(",", ".", re.sub("\.", "", text))))
        if fmt=="fmt:human:RO":         # "1.234,56"
            return float(re.sub("\,", ".", re.sub("\.", "", text)))
        
        if fmt=="fmt:computer,dirty":   # "pret: 1234.56"
            return float(re.sub("[^0-9\.]", "", text))
        if fmt=="fmt:computer":         # "1234.56"
            return float(text)
            
        raise Exception("Invalid rule")
        