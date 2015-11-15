<?php namespace Quamis\PriceMonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\Product;

class ProductHistory extends ComponentBase
{
	public $product;

    public function componentDetails()
    {
        return [
            'name'        => 'Product history',
            'description' => 'A simple list of price variations'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

	public function onRun()
    {
        $this->product = Product::findOrFail($this->param('id'));


        $this->addCss("styles/index.css");

        return parent::onRun();
    }
	
}