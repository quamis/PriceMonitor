<?php namespace Quamis\PriceMonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\ProductAttributes;

class ProductCategories extends ComponentBase
{
    public $categories;

    public function componentDetails()
    {
        return [
            'name'        => 'Category list',
            'description' => 'Categories collected from DB'
        ];
    }

    public function defineProperties()
    {
        return [
            'spider' => [
                'description'       => 'The spider name',
                'title'             => 'spider',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'This should be a valid spider from the database'
            ],
			'section' => [
                'description'       => 'Category',
                'title'             => 'section',
                'default'           => 'category',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'This should be a valid value'
            ],
            'orderBy' => [
                'description'       => 'Order algorithm',
                'title'             => 'orderBy',
                'default'           => 'name',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'Specify the order algorithm'
            ],
        ];
    }
    
    public function onRun()
    {
        $categories = ProductAttributes::select('value')->where('key', 'category')->groupBy('value')->get();
        // @see https://octobercms.com/docs/database/collection
        
        $orderBy = $this->property('orderBy');
        if ($orderBy=='slug:orderBy') {
            $orderBy = $this->param('orderBy');
        }
        switch($orderBy) {
            case 'name':
                $categories = $categories->sort(function($c1, $c2) {
                    return strcmp($c1->value, $c2->value);
                });
            break;
        }
        
        $this->categories = $categories;
        
        $this->addCss("styles/index.css");
        return parent::onRun();
    }
}
