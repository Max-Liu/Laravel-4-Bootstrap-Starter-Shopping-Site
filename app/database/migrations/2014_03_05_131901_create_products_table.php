<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
	        $table->float('price');
	        $table->string('status');
	        $table->integer('stock');
	        $table->longText('description');
	        $table->integer('category_id');
			$table->timestamps();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('products');
	}

}
