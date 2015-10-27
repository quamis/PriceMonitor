from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re
import string

class cel_roSpider(BaseSpider):
    name = "cel.ro"
    allowed_domains = ["www.cel.ro"]
        
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        txt = hxs.xpath("//b[@itemprop='price']/text()").extract()[0]
        product['price'] = float(txt)
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//h2[@itemprop='name']/text()").extract()[0]
        product['details'] = hxs.xpath("//h2[@itemprop='name']/text()").extract()[0]
        
        return [product]
    
