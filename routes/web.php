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

Route::get('/', [
    'as'   => 'dashboard',
    'uses' => 'DashboardController@index',
]);

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

Route::resource('consumers', 'ConsumerController');

Auth::routes();
