<?php namespace Quamis\Pricemonitor\Models;

use Model;

/**
 * product_logs Model
 */
class ProductLogs extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'quamis_pricemonitor_product_logs';

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

}