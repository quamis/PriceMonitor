from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider

class bebebliss_roSpider(BaseSpider):
    name = "bebebliss.ro"
    allowed_domains = ["www.bebebliss.ro"]
    
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        
        priceStr = None
        if priceStr is None:
            txt = hxs.xpath(".//div[@class='price-info']//p[@class='special-price']//span[@class='price']/text()").extract()
            if txt:
                priceStr = txt[0]
            
        if priceStr is None:
            txt = hxs.xpath(".//div[@class='price-info']//span[@class='price']/text()").extract()
            if txt:
                priceStr = txt[0]
                
        product['price'] = self.extractPrice("fmt:human:RO,dirty", priceStr)
        product['currency'] = 'RON'
        product['name'] = hxs.xpath(".//span[@itemprop='name']/text()").extract()[0]
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
