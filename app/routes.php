<?php
Route::group(array('before'=>'auth'),function(){

    Route::resource('products', 'ProductsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('carts', 'CartsController');
    Route::resource('users', 'UsersController');
    Route::resource('tags', 'TagsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('address', 'AddressesController');


// User reset routes
    Route::get('user/remind','RemindersController@getRemind');
    Route::post('user/remind','RemindersController@postRemind');
    Route::get('user/reset/{token}','RemindersController@getReset');
    Route::post('user/reset','RemindersController@PostReset');



    Route::get('/',function(){
        return Redirect::to('/products');
    });
});

Route::get('user/login','UsersController@getLogin');
Route::get('user/logout','UsersController@getLogout');
Route::post('user/login','UsersController@postLogin');


//Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
//Route::post('user/reset/{token}', 'UserController@postReset');


if (Config::get('database.log', false))
{
    Event::listen('illuminate.query', function($query, $bindings, $time, $name)
    {
        $data = compact('bindings', 'time', 'name');

        // Format binding data for sql insertion
        foreach ($bindings as $i => $binding)
        {
            if ($binding instanceof \DateTime)
            {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            }
            else if (is_string($binding))
            {
                $bindings[$i] = "'$binding'";
            }
        }

        // Insert bindings into query
        $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
        $query = vsprintf($query, $bindings);
        Log::info($query, $data);
    });
}
