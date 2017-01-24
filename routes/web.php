<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
Route::resource('consumers', 'ConsumerController');
Route::resource('consumer_orders', 'ConsumerOrderController');
Route::resource('consumer_orders.products', 'ConsumerOrderProductController');
