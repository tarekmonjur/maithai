<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::namespace('Api')->group(function(){
    $route_base_path = 'api';

    /********** ...... Localization API ....... *****************/
    Route::get('/lang', 'ApiController@lang')->name($route_base_path.'.lang');
    Route::post('/send-contact-message', 'ApiController@sendContactMessage')->name($route_base_path.'.send.contact.message');

    /********** ...... Auth API ....... *****************/
    Route::namespace('Auth')->prefix('/')->group(function() use ($route_base_path){
        /********** ...... Customer Auth API ....... *****************/
        Route::post('/login','CustomerLoginController@login')->name($route_base_path.'.customer.login');
        Route::get('/logout','CustomerLoginController@logout')->name($route_base_path.'.customer.logout');
    });

    /********** ...... Category API ....... *****************/
    Route::prefix('/categories')->group(function() use ($route_base_path){
        Route::get('/','CategoryController@index')->name($route_base_path.'.categories.index');
        Route::prefix('/{id_slug}')->group(function () use ($route_base_path){
            Route::get('/','CategoryController@show')->name($route_base_path.'.categories.show');
            Route::get('/subcategories','SubCategoryController@index')->name($route_base_path.'.categories.subcategories.index');
        });
        Route::post('','CategoryController@store')->name($route_base_path.'.categories.store');
        Route::put('/{id}','CategoryController@update')->name($route_base_path.'.categories.update');
        Route::delete('/{id}','CategoryController@destroy')->name($route_base_path.'.categories.destroy');
    });

    /********** ...... Sub Category API ....... *****************/
    Route::prefix('/subcategories')->group(function() use ($route_base_path){
        Route::get('/','SubCategoryController@index')->name($route_base_path.'.subcategories.index');
        Route::get('/{id_slug}','SubCategoryController@show')->name($route_base_path.'.subcategories.show');
        Route::post('','SubCategoryController@store')->name($route_base_path.'.subcategories.store');
        Route::put('/{id}','SubCategoryController@update')->name($route_base_path.'.subcategories.update');
        Route::delete('/{id}','SubCategoryController@destroy')->name($route_base_path.'.subcategories.destroy');
    });

    /********** ...... Unit API ....... *****************/
    Route::prefix('/units')->group(function() use ($route_base_path){
        Route::get('/','UnitController@index')->name($route_base_path.'.units.index');
        Route::get('/{id}','UnitController@show')->name($route_base_path.'.units.show');
        Route::post('','UnitController@store')->name($route_base_path.'.units.store');
        Route::put('/{id}','UnitController@update')->name($route_base_path.'.units.update');
        Route::delete('/{id}','UnitController@destroy')->name($route_base_path.'.units.destroy');
    });

    /********** ...... Variant API ....... *****************/
    Route::prefix('/variants')->group(function() use ($route_base_path){
        Route::get('/','VariantController@index')->name($route_base_path.'.variants.index');
        Route::prefix('/{id}')->group(function () use ($route_base_path){
            Route::get('/','VariantController@show')->name($route_base_path.'.variants.show');
            Route::get('/subvariants','SubVariantController@index')->name($route_base_path.'.variants.subvariants.index');
        });
        Route::post('','VariantController@store')->name($route_base_path.'.variants.store');
        Route::put('/{id}','VariantController@update')->name($route_base_path.'.variants.update');
        Route::delete('/{id}','VariantController@destroy')->name($route_base_path.'.variants.destroy');
    });

    /********** ...... Sub Variant API ....... *****************/
    Route::prefix('/subvariants')->group(function() use ($route_base_path){
        Route::get('/','SubVariantController@index')->name($route_base_path.'.subvariants.index');
        Route::get('/{id}','SubVariantController@show')->name($route_base_path.'.subvariants.show');
        Route::post('','SubVariantController@store')->name($route_base_path.'.subvariants.store');
        Route::put('/{id}','SubVariantController@update')->name($route_base_path.'.subvariants.update');
        Route::delete('/{id}','SubVariantController@destroy')->name($route_base_path.'.subvariants.destroy');
    });

    /********** ...... Product API ....... *****************/
    Route::prefix('/products')->group(function() use ($route_base_path){
        Route::get('/','ProductController@index')->name($route_base_path.'.product.index');
        Route::get('/{id_slug}','ProductController@show')->name($route_base_path.'.product.show');
        Route::post('','ProductController@store')->name($route_base_path.'.product.store');
        Route::put('/{id}','ProductController@update')->name($route_base_path.'.product.update');
        Route::delete('/{id}','ProductController@destroy')->name($route_base_path.'.product.destroy');
    });

    /********** ...... SKU API ....... *****************/
    Route::prefix('/skus')->group(function() use ($route_base_path){
        Route::get('/','SkuController@index')->name($route_base_path.'.sku.index');
        Route::get('/{id}','SkuController@show')->name($route_base_path.'.sku.show');
        Route::post('','SkuController@store')->name($route_base_path.'.sku.store');
        Route::put('/{id}','SkuController@update')->name($route_base_path.'.sku.update');
        Route::delete('/{id}','SkuController@destroy')->name($route_base_path.'.sku.destroy');
    });

    /********** ...... Customer API ....... *****************/
    Route::prefix('/customers')->group(function() use ($route_base_path){
        Route::get('/','CustomerController@index')->name($route_base_path.'.customer.index');
        Route::get('/{id}','CustomerController@show')->name($route_base_path.'.customer.show');
        Route::post('','CustomerController@store')->name($route_base_path.'.customer.store');
        Route::put('/{id}','CustomerController@update')->name($route_base_path.'.customer.update');
        Route::delete('/{id}','CustomerController@destroy')->name($route_base_path.'.customer.destroy');
    });

    /********** ...... Order API ....... *****************/
    Route::prefix('/orders')->group(function() use ($route_base_path){
        Route::get('/','OrderController@index')->name($route_base_path.'.order.index');
        Route::get('/{id}','OrderController@show')->name($route_base_path.'.order.show');
        Route::post('','OrderController@store')->name($route_base_path.'.order.store');
        Route::put('/{id}','OrderController@update')->name($route_base_path.'.order.update');
        Route::put('/{id}/status','OrderController@updateStatus')->name($route_base_path.'.order.status');
        Route::delete('/{id}','OrderController@destroy')->name($route_base_path.'.order.destroy');
    });

    /********** ...... Table API ....... *****************/
    Route::prefix('/tables')->group(function() use ($route_base_path){
        Route::get('/','TableController@index')->name($route_base_path.'.table.index');
        Route::get('/{id}','TableController@show')->name($route_base_path.'.table.show');
        Route::post('','TableController@store')->name($route_base_path.'.table.store');
        Route::put('/{id}','TableController@update')->name($route_base_path.'.table.update');
        Route::delete('/{id}','TableController@destroy')->name($route_base_path.'.table.destroy');
    });

    /********** ...... User API ....... *****************/
    Route::prefix('/users')->group(function() use ($route_base_path){
        Route::get('/','UserController@index')->name($route_base_path.'.user.index');
        Route::get('/{id}','UserController@show')->name($route_base_path.'.user.show');
        Route::post('','UserController@store')->name($route_base_path.'.user.store');
        Route::put('/{id}','UserController@update')->name($route_base_path.'.user.update');
        Route::delete('/{id}','UserController@destroy')->name($route_base_path.'.user.destroy');
    });

    /********** ...... User Type API ....... *****************/
    Route::prefix('/user-types')->group(function() use ($route_base_path){
        Route::get('/','UserTypeController@index')->name($route_base_path.'.userType.index');
    });

    /********** ...... User Service Type API ....... *****************/
    Route::prefix('/user-services')->group(function() use ($route_base_path){
        Route::get('/','UserServiceController@index')->name($route_base_path.'.userService.index');
    });

    /********** ...... User Status API ....... *****************/
    Route::prefix('/user-status')->group(function() use ($route_base_path){
        Route::get('/','UserStatusController@index')->name($route_base_path.'.userStatus.index');
    });

    /********** ...... Settings API ....... *****************/
    Route::prefix('/settings')->group(function() use ($route_base_path){
        Route::get('/','SettingsController@index')->name($route_base_path.'.settings.index');
        Route::put('/{key}','SettingsController@update')->name($route_base_path.'.settings.update');
    });

});
