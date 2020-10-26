<?php

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$route_base_path = env('APP_NAME');

/********** ......Backend Auth Routes....... *****************/
Route::prefix($route_base_path)->namespace('Backend\Auth')->group(function() use ($route_base_path){
    //Login Routes...
    Route::get('login', 'LoginController@showLoginForm')->name($route_base_path.'.login');
    Route::post('login', 'LoginController@login')->name($route_base_path.'.login');
    Route::get('logout', 'LoginController@logout')->name($route_base_path.'.logout');

    //Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token?}', 'ResetPasswordController@showResetForm');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

/********** ......Backend Admin Dashboard Routes....... *****************/
Route::prefix($route_base_path)->namespace('Backend')->group(function() use ($route_base_path){
    Route::get('/','DashboardController@index');
//    Route::get('/settings','DashboardController@settings');
//    Route::put('/settings','DashboardController@updateSettings');
});