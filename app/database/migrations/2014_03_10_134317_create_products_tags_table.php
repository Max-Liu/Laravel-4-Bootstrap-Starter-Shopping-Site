<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('products_tags', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('tag_id');
			$table->timestamps();

            $table->index('product_id');
            $table->index('tag_id');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('products_tags');
	}

}
