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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {

    $repository = app()->make('CodeDelivery\Repositories\CategoryRepository');
    return $repository->all();
});


Route::get('/admin/categories', ['uses' => 'CategoriesController@index', 'as' =>'admin.categories.index']);
Route::get('/admin/categories/edit/{id}', ['uses' => 'CategoriesController@edit', 'as' =>'admin.categories.edit']);
Route::post('/admin/categories/update/{id}', ['uses' => 'CategoriesController@update', 'as' =>'admin.categories.update']);
Route::get('/admin/categories/create', ['uses' => 'CategoriesController@create', 'as' =>'admin.categories.create']);
Route::post('/admin/categories/store', ['uses' => 'CategoriesController@store', 'as' =>'admin.categories.store']);

Route::get('/admin/products', ['uses' => 'ProductsController@index', 'as' =>'admin.products.index']);
Route::get('/admin/products/edit/{id}', ['uses' => 'ProductsController@edit', 'as' =>'admin.products.edit']);
Route::post('/admin/products/update/{id}', ['uses' => 'ProductsController@update', 'as' =>'admin.products.update']);
Route::get('/admin/products/create', ['uses' => 'ProductsController@create', 'as' =>'admin.products.create']);
Route::post('/admin/products/store', ['uses' => 'ProductsController@store', 'as' =>'admin.products.store']);
Route::get('/admin/products/destroy/{id}', ['uses' => 'ProductsController@destroy', 'as' =>'admin.products.destroy']);