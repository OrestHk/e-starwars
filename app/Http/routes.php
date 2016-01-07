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

// Global vars
define('IMG_PATH_BACK', 'public/assets/images/products/');
#aparament c'est la méme en front et back
define('IMG_PATH_FRONT', 'assets/images/products/');

/** Front **/
// Home
Route::get('/', 'FrontController@home');
// Products
Route::get('products', 'FrontController@products');
Route::get('products/{page}', 'FrontController@products');
Route::get('product/{slug}', 'FrontController@singleProduct');
Route::get('category/{slug}', 'FrontController@categoryProducts');
Route::get('category/{slug}/{page}', 'FrontController@categoryProducts');
Route::get('tag/{slug}', 'FrontController@tagProducts');
Route::get('tag/{slug}/{page}', 'FrontController@tagProducts');
// Order
Route::get('order','FrontController@order');
Route::post('validationOrder','FrontController@validationOrder');
Route::post('orderObj/','FrontController@getOrderProduct');
// Conctact
Route::get('contact/', 'ContactController@show');
Route::post('contact/send/', 'ContactController@send');

/** Back **/
//Auth
Route::controller('auth', 'Auth\AuthController');

//admin Route
Route::get('dashboard', 'Admin\DashboardController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('product', 'Admin\ProductController');
    Route::resource('history','Admin\HistoryController');
});
