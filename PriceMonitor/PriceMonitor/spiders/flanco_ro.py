from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re

class flanco_roSpider(BaseSpider):
    name = "flanco.ro"
    allowed_domains = ["www.flanco.ro"]

    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        
        txts = hxs.xpath("//div[contains(@class,'price-box')]/*[1]//span[@class='price']/text()").extract()
        txt = (txts[0] if len(txts)==2 else txts[1]) + \
              hxs.xpath("//div[contains(@class,'price-box')]/*[1]//span[@class='price']/sup/text()").extract()[-1]

        product['price'] = float(re.sub("[^0-9\.]", "", re.sub("\,", ".", re.sub("\.", "", txt))))
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//h1[@class='product-name']/text()").extract()[0].strip()
        product['details'] = hxs.xpath("//h1[@class='product-name']/text()").extract()[0].strip()
        
        return [product]
    
