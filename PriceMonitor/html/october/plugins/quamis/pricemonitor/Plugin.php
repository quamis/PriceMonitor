<?php namespace Quamis\PriceMonitor;

use System\Classes\PluginBase;

/**
 * PriceMonitor Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'PriceMonitor',
            'description' => 'Render stored prices from price monitor',
            'author'      => 'Quamis',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Quamis\PriceMonitor\Components\ProductCategories' => 'ProductCategories',
			'\Quamis\PriceMonitor\Components\ProductAdd' => 'ProductAdd',
			'\Quamis\PriceMonitor\Components\ProductList' => 'ProductList',
			'\Quamis\PriceMonitor\Components\ProductInfo' => 'ProductInfo',
            '\Quamis\PriceMonitor\Components\ProductDetails' => 'ProductDetails',
			'\Quamis\PriceMonitor\Components\ProductHistory' => 'ProductHistory',
			'\Quamis\PriceMonitor\Components\ProductAttributes' => 'ProductAttribtues',
        ];
    }

}
