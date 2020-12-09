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
        Route::get('/{id_slug}','CategoryController@show')->name($route_base_path.'.categories.show');
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
        Route::get('/{id}','VariantController@show')->name($route_base_path.'.variants.show');
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

});
