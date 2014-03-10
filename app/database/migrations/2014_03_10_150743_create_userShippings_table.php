<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserShippingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_shippings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->longText('address');
            $table->string('city');
            $table->string('country');
            $table->string('postcode');
            $table->string('province');
            $table->tinyInteger('is_default');
            $table->integer('user_id');
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
	    Schema::drop('user_shippings');
	}

}
