<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
	$cart = new Cart;

	$items = array(
		'id' => 1,
		'name' => 'iphone4',
		'qty' => 4,
		'price' => 29.99
	);
	$items = array(
		'id' => 2,
		'name' => 'ipad',
		'qty' => 4,
		'price' => 400
	);

	var_dump($cart->insert($items));

});

Route::resource('admins', 'AdminsController');

