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

/********** ......Frontend Auth Routes....... *****************/
Route::prefix('/')->namespace('Frontend\Auth')->group(function(){

    //Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token?}', 'ResetPasswordController@showResetForm');
    Route::post('password/reset', 'ResetPasswordController@reset');

    // Verify User Email
    Route::get('verify-email', 'LoginController@sendVerifyEmail');
    Route::get('verify-email/{token}', 'LoginController@verifyEmail');
});


Route::prefix('/')->namespace('Frontend')->group(function(){
    Route::get('/', 'WebController@index');
    Route::get('/food-orders/{slug?}', 'WebController@product');
    Route::get('/food-package/{slug?}', 'WebController@package');
    Route::get('/about', 'WebController@about');
    Route::get('/contact', 'WebController@contact');
    Route::get('/terms-policy', 'WebController@termsPolicy');
    Route::get('/signup', 'WebController@showRegistration');
    Route::get('/login', 'WebController@showLogin')->name('login');
    Route::get('/logout', 'WebController@logout');

    Route::get('/my-orders', 'DashboardController@myOrder');
});
