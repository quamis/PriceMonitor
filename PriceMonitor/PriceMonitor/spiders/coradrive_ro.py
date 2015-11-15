from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re
import string

class coradrive_roSpider(BaseSpider):
    name = "coradrive.ro"
    allowed_domains = ["www.coradrive.ro"]

    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        # .//*[@id='offer-price-stock']/div[contains(@class,'prices')]
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        txt = hxs.xpath(".//div[@class='price']/span[1]/text()").extract()[0]
        product['price'] = float(re.sub("[^0-9\.]", "", re.sub(",", ".", re.sub("\.", "", txt))))
        product['currency'] = 'RON'
        product['name'] = hxs.xpath(".//h1/text()").extract()[0]
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
        