<?php namespace Quamis\PriceMonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\Product;

class ProductDetails extends ComponentBase
{
    public $product;

    public function componentDetails()
    {
        return [
            'name'        => 'Product details',
            'description' => 'A info box.'
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