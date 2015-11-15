from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider

class promomix_roSpider(BaseSpider):
    name = "promomix.ro"
    allowed_domains = ["www.promomix.ro"]
        
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        # .//*[@id='offer-price-stock']/div[contains(@class,'prices')]
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        product['price'] = self.extractPrice("fmt:computer,dirty", hxs.xpath(".//div[contains(@class,'product-price')]/div[@class='PricesalesPrice']/span[@class='PricesalesPrice'][1]/text()").extract()[0])
        product['currency'] = 'RON'
        product['name'] = hxs.xpath(".//div[contains(@class, 'productdetails')]//h1/text()").extract()[0]
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
    
