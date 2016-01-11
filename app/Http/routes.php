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
Route::post('order/validation/','FrontController@validationOrder');
// Conctact
Route::get('contact/', 'ContactController@show');
Route::post('contact/send/', 'ContactController@send');
// Legal
Route::get('legal/', 'FrontController@legal');

/** Back **/
// Admin middleware
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
    // Admin Route
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('product', 'Admin\ProductController');
        Route::resource('order','Admin\orderController');
    });
});
// Log route
Route::get('dashboard', 'Admin\DashboardController@index');
// Auth
Route::controller('auth', 'Auth\AuthController');
