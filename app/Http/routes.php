<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => 'auth.checkrole:admin'],function(){

    Route::group(['prefix'=>'categories','as'=>'categories.'],function(){
        
        Route::get('/', ['uses' => 'CategoriesController@index', 'as' =>'index']);
        Route::get('edit/{id}', ['uses' => 'CategoriesController@edit', 'as' =>'edit']);
        Route::post('update/{id}', ['uses' => 'CategoriesController@update', 'as' =>'update']);
        Route::get('create', ['uses' => 'CategoriesController@create', 'as' =>'create']);
        Route::post('store', ['uses' => 'CategoriesController@store', 'as' =>'store']);
        Route::get('destroy/{id}', ['uses' => 'CategoriesController@destroy', 'as' =>'destroy']);
        
    });

    Route::group(['prefix'=>'products','as'=>'products.'],function(){
        
        Route::get('/', ['uses' => 'ProductsController@index', 'as' =>'index']);
        Route::get('edit/{id}', ['uses' => 'ProductsController@edit', 'as' =>'edit']);
        Route::post('update/{id}', ['uses' => 'ProductsController@update', 'as' =>'update']);
        Route::get('create', ['uses' => 'ProductsController@create', 'as' =>'create']);
        Route::post('store', ['uses' => 'ProductsController@store', 'as' =>'store']);
        Route::get('destroy/{id}', ['uses' => 'ProductsController@destroy', 'as' =>'destroy']);
        
    });


    Route::group(['prefix'=>'clients','as'=>'clients.'],function(){

        Route::get('/', ['uses' => 'ClientsController@index', 'as' =>'index']);
        Route::get('edit/{id}', ['uses' => 'ClientsController@edit', 'as' =>'edit']);
        Route::post('update/{id}', ['uses' => 'ClientsController@update', 'as' =>'update']);
        Route::get('create', ['uses' => 'ClientsController@create', 'as' =>'create']);
        Route::post('store', ['uses' => 'ClientsController@store', 'as' =>'store']);
        Route::get('destroy/{id}', ['uses' => 'ClientsController@destroy', 'as' =>'destroy']);

    });

    Route::group(['prefix'=>'orders','as'=>'orders.'],function(){

        Route::get('/', ['uses' => 'OrdersController@index', 'as' =>'index']);
        Route::get('edit/{id}', ['uses' => 'OrdersController@edit', 'as' =>'edit']);
        Route::post('update/{id}', ['uses' => 'OrdersController@update', 'as' =>'update']);
        Route::get('create', ['uses' => 'OrdersController@create', 'as' =>'create']);
        Route::post('store', ['uses' => 'OrdersController@store', 'as' =>'store']);
        Route::get('destroy/{id}', ['uses' => 'OrdersController@destroy', 'as' =>'destroy']);

    });

    Route::group(['prefix'=>'cupoms','as'=>'cupoms.'],function(){

        Route::get('/', ['uses' => 'CupomsController@index', 'as' =>'index']);
        Route::get('edit/{id}', ['uses' => 'CupomsController@edit', 'as' =>'edit']);
        Route::post('update/{id}', ['uses' => 'CupomsController@update', 'as' =>'update']);
        Route::get('create', ['uses' => 'CupomsController@create', 'as' =>'create']);
        Route::post('store', ['uses' => 'CupomsController@store', 'as' =>'store']);
        Route::get('destroy/{id}', ['uses' => 'CupomsController@destroy', 'as' =>'destroy']);

    });
});


Route::group(['prefix'=>'customer','as'=>'customer.', 'middleware' => 'auth.checkrole:client'],function(){

    Route::get('order/create', ['uses' => 'CheckoutController@create', 'as' =>'order.create']);
    Route::post('order/post', ['uses' => 'CheckoutController@store', 'as' =>'order.store']);
    Route::get('order', ['uses' => 'CheckoutController@index', 'as' =>'order.index']);

});

Route::group(['prefix'=>'api','as'=>'api.', 'middleware' => 'oauth'],function(){



    Route::group(['prefix'=>'client','as'=>'client.', 'middleware' => 'oauth.checkrole:client' ],function(){

        Route::resource('order',
            'Api\Client\ClientCheckoutController',
            ['except' => ['create','edit','destroy']]
        );

    });

    Route::group(['prefix'=>'deliveryman','as'=>'deliveryman.', 'middleware' => 'oauth.checkrole:deliveryman'],function(){

        Route::resource('order',
            'Api\Deliveryman\DeliverymanCheckoutController',
            ['except' => ['create','edit','destroy','store']]
        );

        Route::patch('order/{id}/update-status', [
            'uses'  => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus',
            'as'    => 'orders.update_status'
        ]);
    });



});




Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});