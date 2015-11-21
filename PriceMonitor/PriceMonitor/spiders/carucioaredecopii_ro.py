from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider

class carucioaredecopii_roSpider(BaseSpider):
    name = "carucioaredecopii.ro"
    allowed_domains = ["www.carucioaredecopii.ro"]
    
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        
        priceStr = None
        if priceStr is None:
            txt = hxs.xpath(".//div[@class='price']//span[@class='price-new']/text()").extract()
            if txt:
                priceStr = txt[0]
                
        product['price'] = self.extractPrice("fmt:human:RO,dirty", priceStr)
        product['currency'] = 'RON'
        product['name'] = hxs.xpath(".//span[@class='h1-top']/text()").extract()[0]
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
