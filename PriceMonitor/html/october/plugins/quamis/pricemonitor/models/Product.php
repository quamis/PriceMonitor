<?php namespace Quamis\Pricemonitor\Models;

use Model;
use Quamis\Pricemonitor\Models\ProductLogs;

/**
 * products Model
 */
class Product extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'quamis_pricemonitor_product';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

	public $logs;
	public $productAttributes;
	
	public function getLogs()
	{
		if ($this->logs==null) {
			$this->logs = ProductLogs::where('id', $this->id)->orderBy('updated_at', 'ASC')->get();
		}
		
		return $this->logs;
	}
	
	public function firstLog()
	{
		return $this->getLogs()->first();
	}

	public function lastLog()
	{
		return $this->getLogs()->last();
	}
	
	public function prices()
	{
		$prices = Array();
		foreach ($this->getLogs() as $log) {
			$prices[] = $log->price;
		}
		
		return $prices;
	}
	
	public function minPrice()
	{
		return min($this->prices());
	}
	
	public function maxPrice()
	{
		return max($this->prices());
	}
	
	public function productAttributes()
	{
		if ($this->productAttributes==null) {
			$attributes = ProductAttributes::where('id', 'LIKE', "{$this->id}.%")->get();
			$this->productAttributes = Array();
			foreach ($attributes as $attr) {
				$this->productAttributes[$attr->key] = $attr;
			}
		}
		
		return $this->productAttributes;
	}
}