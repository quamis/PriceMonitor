import os
ENV = os.environ

# Scrapy settings for ExchangeRate project
#
# For simplicity, this file contains only the most important settings by
# default. All the other settings are documented here:
#
#     http://doc.scrapy.org/topics/settings.html
#

BOT_NAME = 'PriceMonitor'
CONCURRENT_REQUESTS = 2
CONCURRENT_REQUESTS_PER_DOMAIN = 2
DOWNLOAD_DELAY = 15
RANDOMIZE_DOWNLOAD_DELAY = True

SPIDER_MODULES = ['PriceMonitor.spiders']
NEWSPIDER_MODULE = 'PriceMonitor.spiders'

# Crawl responsibly by identifying yourself (and your website) on the user-agent
USER_AGENT = 'PriceMonitor v0.1'
#USER_AGENT = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0"

ITEM_PIPELINES = {
    'PriceMonitor.pipelines.PriceMonitorPipeline': 300,
    'PriceMonitor.pipelines.StoragePipeline': 900,
}


DB_HOST = 'localhost'
DB_NAME = ENV['PRICEMONITOR_DB_DATABASE']
DB_USER = ENV['PRICEMONITOR_DB_USER']
DB_PASS = ENV['PRICEMONITOR_DB_PASS']
