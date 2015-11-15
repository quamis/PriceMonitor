from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re
import string

class mediadot_roSpider(BaseSpider):
    name = "mediadot.ro"
    allowed_domains = ["www.mediadot.ro"]
        
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        if not hxs.xpath(".//span[@itemprop='price']/text()").extract():
            return None
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        txt = hxs.xpath(".//span[@itemprop='price']/text()").extract()[0]
        product['price'] = self.extractPrice("fmt:human:RO,dirty", txt)
        product['currency'] = 'RON'
        product['name'] = re.sub("[\s]+", " ", hxs.xpath(".//span[@itemprop='name']/../text()").extract()[0] + " " + hxs.xpath(".//span[@itemprop='name']/text()").extract()[0])
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
    
