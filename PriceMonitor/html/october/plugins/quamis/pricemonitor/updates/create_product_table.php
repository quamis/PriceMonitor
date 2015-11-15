<?php namespace Quamis\Pricemonitor\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProductTable extends Migration
{

    public function up()
    {
        Schema::create('quamis_pricemonitor_product', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('id', 64)->primary();
			$table->boolean('active');
            $table->string('url')->unique();
            $table->string('spider', 32)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quamis_pricemonitor_product');
    }

}
