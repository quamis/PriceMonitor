<?php namespace Quamis\Pricemonitor\Models;

use Model;

/**
 * product_tags Model
 */
class ProductAttributes extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'quamis_pricemonitor_product_attributes';

	public $incrementing  = false;


    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['id', 'key'];

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
}