<?php namespace Quamis\Pricemonitor\Components;

use Cms\Classes\ComponentBase;
use Quamis\Pricemonitor\Models\Product;
use Quamis\Pricemonitor\Models\ProductAttributes as ModelProductAttributes;

class ProductAttributes extends ComponentBase
{
	public $product;
	
    public function componentDetails()
    {
        return [
            'name'        => 'Product tags edit',
            'description' => 'Edit the pre-defined tags'
        ];
    }

    public function defineProperties()
    {
		return [];
    }
	
	public function onRun()
    {

        $this->product = Product::findOrFail($this->param('id'));

        // $this->addCss("styles/index.css");

        return parent::onRun();
    }
	
	public function onSave()
    {
		$product = Product::findOrFail($this->param('id'));
		$attributes = Array('category', 'quantity', 'quantity_UM', );
		foreach ($attributes as $attr) {
			$key = sprintf("%s.%s", $product->id, $attr);
			$attribute = ModelProductAttributes::firstOrNew(['id'=>$key]);
			$attribute->key = $attr;
			$attribute->value = post($attr);
			$attribute->save();
		}
    }
}
