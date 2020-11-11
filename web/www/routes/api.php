<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$route_base_path = 'api';
/********** ...... Category API ....... *****************/
Route::prefix('/categories')->namespace('Api')->group(function() use ($route_base_path){
    Route::get('/','CategoryController@index')->name($route_base_path.'.categories');
});
