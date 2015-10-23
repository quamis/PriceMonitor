from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider
import re
import string

class pcgarage_roSpider(BaseSpider):
    name = "pcgarage.ro"
    allowed_domains = ["www.pcgarage.ro"]

    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        # .//*[@id='offer-price-stock']/div[contains(@class,'prices')]
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        txt = hxs.xpath(".//span[@itemprop='price']/text()").extract()[0]
        product['price'] = float(re.sub("[^0-9\.]", "", re.sub(",", ".", re.sub("\.", "", txt))))
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//h1[@class='p-name']/text()").extract()[0]
        product['details'] = hxs.xpath("//h1[@class='p-name']/text()").extract()[0]
        
        return [product]
        