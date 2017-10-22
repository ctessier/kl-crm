<?php

/*
|--------------------------------------------------------------------------
| Profile routes
|--------------------------------------------------------------------------
|
| Set of profile routes for showing and update the authenticated user
| information, included the password.
|
*/
Route::get('profile', [
    'as'   => 'profile.show',
    'uses' => 'ProfileController@show',
]);
Route::put('profile', [
    'as'   => 'profile.update',
    'uses' => 'ProfileController@update',
]);
Route::put('profile/password/update', [
    'as'   => 'profile.password.update',
    'uses' => 'Auth\UpdatePasswordController@update',
]);

/*
|--------------------------------------------------------------------------
| Stock routes
|--------------------------------------------------------------------------
|
| Set of routes for the stock.
|
*/
Route::get('stock', [
    'as'   => 'stock.edit',
    'uses' => 'StockController@edit',
]);

Route::post('stock', [
    'as'   => 'stock.update',
    'uses' => 'StockController@update',
]);

/*
|--------------------------------------------------------------------------
| Resources routes
|--------------------------------------------------------------------------
|
| Defines the routes of all project's resources.
|
*/
Route::resource('consumers', 'ConsumerController', [
    'except' => ['show', 'destroy'],
]);
Route::resource('consumer_orders', 'ConsumerOrderController', [
    'except' => ['show'],
]);
Route::put('consumer_orders/{consumer_order}/detach', [
    'as'   => 'consumer_orders.detach',
    'uses' => 'ConsumerOrderController@detach',
]);
Route::resource('consumer_orders.products', 'ConsumerOrderProductController', [
    'except' => ['index', 'show'],
]);
Route::resource('orders', 'OrderController', [
    'except' => ['edit', 'update'],
]);
Route::post('orders/{order}/fillers/store', [
    'as'   => 'orders.fillers.store',
    'uses' => 'OrderController@storeFillers',
]);
