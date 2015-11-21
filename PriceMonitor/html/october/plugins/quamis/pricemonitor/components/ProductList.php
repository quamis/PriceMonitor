<?php namespace Quamis\PriceMonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\Product;

class ProductList extends ComponentBase
{
    public $products;
	public $markedElements = Array();

    public function componentDetails()
    {
        return [
            'name'        => 'Products list',
            'description' => 'A hopefully long list.'
        ];
    }

    public function defineProperties()
    {
        return [
            'category' => [
                'description'       => 'The product category',
                'title'             => 'category',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'This should be a valid category path from the database'
            ],
			'spider' => [
                'description'       => 'The spider name',
                'title'             => 'spider',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'This should be a valid spider from the database'
            ],
			'active' => [
                'description'       => 'Product is active',
                'title'             => 'actve',
                'default'           => '1',
                'type'              => 'string',
                'validationPattern' => '^(0|1)$',
                'validationMessage' => 'This should be a bool value'
            ],
			'showOnlyWithPrice' => [
                'description'       => 'Show only products with price min/max',
                'title'             => 'showOnlyWithPrice',
                'default'           => '',
                'type'              => 'string',
                'validationPattern' => '^(min|max|)(:[0-9]+%)$',
                'validationMessage' => 'This should be a valid value(blank, min, max)'
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
        // $products = Product::where('active', true)->orderBy('url', 'ASC')->get();
		$products = Product::all();
		
		// @see https://octobercms.com/docs/database/collection
		
		// remove items without a log
		$products = $products->filter(function($product) {
			return $product->lastLog();
		});
		
		if ($this->property('active')!=='' && $this->property('active')!==null) {
			$filter = (int)$this->property('active');
			if ($filter=='slug:active') {
				$filter = (int)$this->param('active');
			}
			
			$products = $products->filter(function($product) use ($filter) {
				return $product->active==$filter;
			});
		}
		if ($this->property('category')) {
			$filter = $this->property('category');
			if ($filter=='slug:category') {
				$filter = $this->param('category');
			}
			
			if ($filter==':all') {
				$products = $products->filter(function($product) use ($filter) {
					return 1;
				});
			}
			elseif ($filter==':uncategorized') {
				$products = $products->filter(function($product) use ($filter) {
					$hasCtg = ($product->productAttributes() && $product->productAttributes()['category'] && $product->productAttributes()['category']->value);
					return !$hasCtg;
				});
			}
			else {
				$products = $products->filter(function($product) use ($filter) {
					return $product->productAttributes() && $product->productAttributes()['category'] && $product->productAttributes()['category']->value==$filter;
				});
			}
		}
		
		if ($this->property('spider')) {
			$filter = $this->property('spider');
			if ($filter=='slug:spider') {
				$filter = $this->param('spider');
			}
			$products = $products->filter(function($product) use ($filter) {
				return $product->spider==$filter;
			});
		}
		
		if ($this->property('showOnlyWithPrice')) {
			$filter = $this->property('showOnlyWithPrice');
			if ($filter=='slug:showOnlyWithPrice') {
				$filter = $this->param('showOnlyWithPrice');
			}
			$products = $products->filter(function($product) use ($filter) {
				switch($filter) {
					case 'min':
						return $product->lastLog()->price == $product->minPrice();
					break;
					case 'max':
						return $product->lastLog()->price == $product->maxPrice();
					break;
					
					case 'min:10%':
						$diff = $product->maxPrice() - $product->minPrice();
						return $product->lastLog()->price <= $product->minPrice()+$diff*0.10;
					break;
					case 'min:25%':
						$diff = $product->maxPrice() - $product->minPrice();
						return $product->lastLog()->price <= $product->minPrice()+$diff*0.25;
					break;
					case 'min:50%':
						$diff = $product->maxPrice() - $product->minPrice();
						return $product->lastLog()->price <= $product->minPrice()+$diff*0.50;
					break;
					
					default: 
						throw new \Exception("Invalid value for showOnlyWithPrice");
				}
			});
		}
		
		$orderBy = $this->property('orderBy');
		if ($orderBy=='slug:orderBy') {
			$orderBy = $this->param('orderBy');
		}
		
		switch($orderBy) {
			case 'name':
				$products = $products->sort(function($p1, $p2) {
					return strcmp($p1->name, $p2->name);
				});
			break;
			
			case 'price':
				$products = $products->sort(function($p1, $p2) {
					return $p1->lastLog()->price - $p2->lastLog()->price;
				});
			break;
			
			case 'quantity':
				$products = $products->sort(function($p1, $p2) {
					if ($p1->productAttributes() && $p1->productAttributes()['quantity']) {
						return (float)$p1->productAttributes()['quantity']->value - (float)$p2->productAttributes()['quantity']->value;
					}
					return 0;
				});
			break;
			
			case 'pricePerUnit':
				$products = $products->sort(function($p1, $p2) {
					$ret = 0;
					if ($ret==0
						&& $p1->productAttributes() && isset($p1->productAttributes()['quantity']) && $p1->productAttributes()['quantity']->value
						&& $p2->productAttributes() && isset($p2->productAttributes()['quantity']) && $p2->productAttributes()['quantity']->value
						&& $p1->lastLog()->price
						&& $p2->lastLog()->price
						) {
							$pu1 = (float)$p1->lastLog()->price / (float)$p1->productAttributes()['quantity']->value;
							$pu2 = (float)$p2->lastLog()->price / (float)$p2->productAttributes()['quantity']->value;
						return ($pu1 - $pu2)*100;	// usort should return integer numbers, so that 1.99 != 1.01
					}
					
					if ($ret==0) {
						if ($p1->lastLog() && $p2->lastLog()) {
							$ret = $p1->lastLog()->price - $p2->lastLog()->price;
						}
					}
					
					return $ret;
				});
			break;
			
			case 'category,pricePerUnit':
				$products = $products->sort(function($p1, $p2) {
					$ret = 0;
					if ($ret==0) {
						if ( $p1->productAttributes() && $p1->productAttributes()['category'] && $p1->productAttributes()['category']->value
						  && $p2->productAttributes() && $p2->productAttributes()['category'] && $p2->productAttributes()['category']->value) {
							$ret = strcmp($p1->productAttributes()['category']->value, $p2->productAttributes()['category']->value);
						}
					}
					
					if ($ret==0
						&& $p1->productAttributes() && isset($p1->productAttributes()['quantity']) && $p1->productAttributes()['quantity']->value
						&& $p2->productAttributes() && isset($p2->productAttributes()['quantity']) && $p2->productAttributes()['quantity']->value
						&& $p1->lastLog()->price
						&& $p2->lastLog()->price
						) {
							$pu1 = (float)$p1->lastLog()->price / (float)$p1->productAttributes()['quantity']->value;
							$pu2 = (float)$p2->lastLog()->price / (float)$p2->productAttributes()['quantity']->value;
						return ($pu1 - $pu2)*100;	// usort should return integer numbers, so that 1.99 != 1.01
					}
					
					if ($ret==0) {
						if ($p1->lastLog() && $p2->lastLog()) {
							$ret = $p1->lastLog()->price - $p2->lastLog()->price;
						}
					}
					
					return $ret;
				});
			break;
			
			case 'quantity,price':
				$products = $products->sort(function($p1, $p2) {
					$ret = 0;
					
					if ($ret==0 
						&& $p1->productAttributes() && isset($p1->productAttributes()['category']) && $p1->productAttributes()['category']->value
						&& $p2->productAttributes() && isset($p2->productAttributes()['category']) && $p2->productAttributes()['category']->value
						) {
						$ret = strcmp($p1->productAttributes()['category']->value, $p2->productAttributes()['category']->value);
					}
					
					if ($ret==0 
						&& $p1->productAttributes() && isset($p1->productAttributes()['quantity']) && $p1->productAttributes()['quantity']->value
						&& $p2->productAttributes() && isset($p2->productAttributes()['quantity']) && $p2->productAttributes()['quantity']->value
						) {
						$ret = (float)$p1->productAttributes()['quantity']->value - (float)$p2->productAttributes()['quantity']->value;
					}
					
					if ($ret==0) {
						if ($p1->lastLog() && $p2->lastLog()) {
							$ret = $p1->lastLog()->price - $p2->lastLog()->price;
						}
					}
					
					return $ret;
				});
				
				$stats = Array();
				foreach ($products as $p1) {
					if ($p1->productAttributes() && isset($p1->productAttributes()['quantity']) && $p1->productAttributes()['quantity']->value) {
						$stats[$p1->productAttributes()['quantity']->value]['price'][] = $p1->lastLog()->price;
					}
				}
				
				foreach ($products as $p1) {
					if ($p1->productAttributes() && isset($p1->productAttributes()['quantity']) && $p1->productAttributes()['quantity']->value) {
						$this->markedElements[$p1->id] = Array(
							'priceMin' => (min($stats[$p1->productAttributes()['quantity']->value]['price'])==$p1->lastLog()->price),
							'priceMax' => (max($stats[$p1->productAttributes()['quantity']->value]['price'])==$p1->lastLog()->price),
						);
					}
				}
				
			break;
		}
		
		#var_dump($products);die();
        $this->products = $products;
		
		$this->addCss("styles/index.css");
        return parent::onRun();
    }
}
