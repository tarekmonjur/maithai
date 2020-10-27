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


Route::prefix('/')->namespace('Frontend')->group(function(){
    Route::get('/', 'HomeController@index');
    Route::get('/food-orders', 'HomeController@foodOrder');
    Route::get('/food-package', 'HomeController@foodPackage');
    Route::get('/about', 'HomeController@about');
    Route::get('/contact', 'HomeController@contact');
    Route::get('/terms-policy', 'HomeController@termsPolicy');
});
