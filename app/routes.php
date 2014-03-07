<?php
Route::resource('products', 'ProductsController');
Route::resource('categories', 'CategoriesController');
Route::resource('carts', 'CartsController');
Route::resource('users', 'UsersController');

// User reset routes
Route::get('user/reset','RemindersController@getRemind');
Route::post('user/reset','RemindersController@postRemind');

Route::get('user/login','UsersController@getLogin');
Route::get('user/logout','UsersController@getLogout');
Route::post('user/login','UsersController@postLogin');

Route::get('/',function(){
    var_dump(Session::all());
});

//Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
//Route::post('user/reset/{token}', 'UserController@postReset');
