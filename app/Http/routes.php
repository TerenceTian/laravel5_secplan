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

Route::get('/', 'PagesController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::resource('shops', 'ShopsController');

Route::resource('items', 'ItemsController');

Route::resource('orders', 'OrdersController');
Route::post('orders/{orders}/remove_item', 'OrdersController@removeItem');

Route::get('about', 'PagesController@about');
