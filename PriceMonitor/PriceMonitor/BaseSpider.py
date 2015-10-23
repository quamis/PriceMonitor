import scrapy
from scrapy.spider import BaseSpider
import MySQLdb
import hashlib

class BaseSpider(BaseSpider):
    # INSERT INTO `urls` (`addTime`, `spider`, `url`) VALUES (NOW(), 'emag.ro', 'http://www.emag.ro/televizor-led-horizon-81-cm-hd-32hl730h/pd/DGWNYMBBM/');
    conn = None

    def start_requests(self):
        self.conn = MySQLdb.connect(user=self.settings['DB_USER'], passwd=self.settings['DB_PASS'], db=self.settings['DB_NAME'], host=self.settings['DB_HOST'], charset="utf8", use_unicode=True)
        self.cursor = self.conn.cursor()
        
        self.cursor.execute("""SELECT `URL` FROM `urls` WHERE `spider`=%s ORDER BY RAND() ASC""", (self.name,))
        rows = self.cursor.fetchall()
        for [url] in rows:
            yield scrapy.http.Request(url, self.parse)
        
    def get_id(self, response):
        #return "%s.%s" % (hashlib.md5(self.name).hexdigest()[0:4], hashlib.md5(response.url.lower()).hexdigest())
        return hashlib.md5(response.url).hexdigest()
        