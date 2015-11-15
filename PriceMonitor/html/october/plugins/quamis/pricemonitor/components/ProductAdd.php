<?php namespace Quamis\Pricemonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\Product;

class ProductAdd extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'ProductAdd Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onAddItem()
    {
        $url = post('url');
        $spider = preg_replace("/^www./", "", strtolower(parse_url($url, PHP_URL_HOST)));
        $id = sprintf("%s:%s:%03d:%03d", substr(md5($spider), 0, 3), md5(strtolower($url)), strlen($url), mt_rand(1, 999));

        $product = new Product();
        $product->id = $id;
        $product->spider = $spider;
		$product->active = true;
        $product->url = post('url');
        $product->save();
    }
}
