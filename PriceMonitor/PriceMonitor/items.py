# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/topics/items.html

from scrapy.item import Item, Field

class ProductDetails(Item):
    # define the fields for your item here like:
    # name = Field()
    id = Field()
    URL = Field()
    name = Field()
    price = Field()
    currency = Field()
    description = Field()
    extractedData = Field()
    attributes = Field()
