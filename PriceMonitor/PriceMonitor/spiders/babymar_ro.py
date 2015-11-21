from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider

class babymar_roSpider(BaseSpider):
    name = "babymar.ro"
    allowed_domains = ["www.babymar.ro"]
    
    # http://babymar.ro/scaun-auto-freemove-orange.html
    
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        
        priceStr = None
        if priceStr is None:
            txt = hxs.xpath(".//*[@id='content']//div[@class='price']/span[@class='price-new']/text()").extract()
            if txt:
                priceStr = txt[0]
            
        if priceStr is None:
            txt = hxs.xpath(".//*[@id='content']//div[@class='price']/text()").extract()
            if txt:
                priceStr = txt[0]
                
        product['price'] = self.extractPrice("fmt:human:RO,dirty", priceStr)
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//*[@id='content']//h1/text()").extract()[0]
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
