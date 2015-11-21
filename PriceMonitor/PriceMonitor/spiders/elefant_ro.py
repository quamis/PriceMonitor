from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider

class elefant_roSpider(BaseSpider):
    name = "elefant.ro"
    allowed_domains = ["www.elefant.ro"]
    
    # http://www.elefant.ro/kids/scaune-auto/scaune-copii/babygo-scaun-auto-freemove-verde-verde-13124-32.html
    
    def parse(self, response):
        """
        hxs = Selector(response)
        product = ProductDetails()
        
        if hxs.xpath("//*[@id='offer-price-stock-add']/span/text()").extract():
            return None
        
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        product['price'] = float(hxs.xpath("//*[@id='offer-price-stock']/div[contains(@class,'prices')]/span[@itemprop='price']/@content").extract()[0])
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//*[@id='offer-title']/h1/text()").extract()[0]
        product['description'] = ''
        product['attributes'] =     self.determineAttributes(product['name'])
        product['extractedData'] = {}
        
        return [product]
        """
