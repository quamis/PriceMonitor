<?php namespace Quamis\PriceMonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\Product;

class ProductInfo extends ComponentBase
{
	public $product;

    public function componentDetails()
    {
        return [
            'name'        => 'Product info',
            'description' => 'A short description of the product'
        ];
    }

    public function defineProperties()
    {
        return [
			'showTitle' => [
				 'title'             => 'Show title',
				 'description'       => 'Render the product title',
				 'default'           => false,
				 'type'              => 'checkbox',
			],
			'showPrice' => [
				 'title'             => 'Show price',
				 'description'       => 'Render the product price',
				 'default'           => false,
				 'type'              => 'checkbox',
			]
		];
    }

	public function onRun()
    {
        $this->product = Product::findOrFail($this->param('id'));

        $this->addCss("styles/index.css");

        return parent::onRun();
    }
	
}