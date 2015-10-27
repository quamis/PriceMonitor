from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re
import string

class azerty_roSpider(BaseSpider):
    name = "azerty.ro"
    allowed_domains = ["www.azerty.ro"]
        
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        txt = hxs.xpath("//span[@itemprop='price']/text()").extract()[0]
        product['price'] = float(re.sub("[^0-9\.]", "", re.sub(",", ".", re.sub("\.", "", txt))))
        product['currency'] = 'RON'
        product['name'] = hxs.xpath(".//*[@id='productdetails']//p[@class='title']/text()").extract()[0]
        product['details'] = hxs.xpath(".//*[@id='productdetails']//p[@class='title']/text()").extract()[0]
        
        return [product]
    
