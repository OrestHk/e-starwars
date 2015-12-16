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
define('IMG_PATH_FRONT', 'assets/images/products/');

Route::get('/','FrontController@index');
