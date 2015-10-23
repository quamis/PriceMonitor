from scrapy.selector import Selector
from PriceMonitor.items import ProductDetails
from PriceMonitor.BaseSpider import BaseSpider

class emag_roSpider(BaseSpider):
    name = "emag.ro"
    allowed_domains = ["www.emag.ro"]
        
    def parse(self, response):
        hxs = Selector(response)
        product = ProductDetails()
        
        # .//*[@id='offer-price-stock']/div[contains(@class,'prices')]
        product['id'] = self.get_id(response)
        product['URL'] = response.url
        product['price'] = float(hxs.xpath("//*[@id='offer-price-stock']/div[contains(@class,'prices')]/span[@itemprop='price']/@content").extract()[0])
        product['currency'] = 'RON'
        product['name'] = hxs.xpath("//*[@id='offer-title']/h1/text()").extract()[0]
        product['details'] = hxs.xpath("//*[@id='offer-title']/h1/text()").extract()[0]
        
        return [product]
    
