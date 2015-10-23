from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re

class mediagalaxy_roSpider(BaseSpider):
    name = "mediagalaxy.ro"
    allowed_domains = ["www.mediagalaxy.ro"]

    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        
        txt = hxs.xpath("//div[contains(@class, 'ProdusPage-actions')]//div[contains(@class, 'Price-current')]/*[1]/text()").extract()[0] + \
              hxs.xpath("//div[contains(@class, 'ProdusPage-actions')]//div[contains(@class, 'Price-current')]/*[2]/text()").extract()[0]
         
        product['price'] = float(re.sub("\,", ".", re.sub("\.", "", txt)))
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//h1[@class='ProdusPage-title']/text()").extract()[0].strip()
        product['details'] = hxs.xpath("//h1[@class='ProdusPage-title']/text()").extract()[0].strip()
        
        return [product]
    
