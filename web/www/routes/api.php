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

});
