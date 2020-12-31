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
        Route::delete('/{id}','OrderController@destroy')->name($route_base_path.'.order.destroy');
    });

});
