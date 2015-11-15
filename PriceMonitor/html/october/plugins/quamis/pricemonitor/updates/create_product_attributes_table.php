<?php namespace Quamis\Pricemonitor\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProductAttributesTable extends Migration
{

    public function up()
    {
        Schema::create('quamis_pricemonitor_product_attributes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('id', 64+32+1)->primary(); // laravel doesn't support multiple primary keys, so i'm concatenating them naually
			$table->string('key', 32);
			$table->string('value', 32);
			
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quamis_pricemonitor_product_attributes');
    }

}
