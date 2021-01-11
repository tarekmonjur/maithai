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

/********** ......Backend Auth Routes....... *****************/
Route::prefix('/')->namespace('Frontend\Auth')->group(function(){
    //Signup Routes...
    Route::get('signup', 'RegisterController@showRegistrationForm');
    Route::post('signup', 'RegisterController@register');

    //Login Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');

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
    Route::get('/', 'HomeController@index');
    Route::get('/food-orders', 'HomeController@product');
    Route::get('/food-package', 'HomeController@package');
    Route::get('/about', 'HomeController@about');
    Route::get('/contact', 'HomeController@contact');
    Route::get('/terms-policy', 'HomeController@termsPolicy');
});
