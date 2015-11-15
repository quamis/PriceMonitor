<?php namespace Quamis\Pricemonitor\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProductLogsTable extends Migration
{

    public function up()
    {
        Schema::create('quamis_pricemonitor_product_logs', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('id', 64);
			$table->string('run_id', 64);
			$table->string('name', 200);
			$table->double('price');
			$table->string('currency', 3);
			$table->text('description');
			$table->text('extractedData');
			
            $table->timestamps();
			
			$table->primary(Array('id', 'run_id'));	// http://laravel.com/docs/4.2/schema#adding-indexes
        });
    }

    public function down()
    {
        Schema::dropIfExists('quamis_pricemonitor_product_logs');
    }

}
