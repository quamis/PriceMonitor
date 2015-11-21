from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re

class oktal_roSpider(BaseSpider):
    name = "oktal.ro"
    allowed_domains = ["www.oktal.ro"]
    
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        
        priceStr = None
        if priceStr is None:
            txt = hxs.xpath(".//*[@itemprop='price']/text()").extract()
            if txt:
                priceStr = txt[0]
                            
        product['price'] = self.extractPrice("fmt:human:RO,dirty", priceStr)
        product['currency'] = 'RON'
        product['name'] = re.sub("([\[\]\s]+)$", "", hxs.xpath(".//h2[@itemprop='name']/text()").extract()[0])
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
