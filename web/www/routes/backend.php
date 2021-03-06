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

$route_base_path = config('app.backend_home', 'pos');

/********** ......Backend Auth Routes....... *****************/
Route::prefix('')->namespace('Backend\Auth')->group(function() use ($route_base_path){
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

/********** ......Backend Dashboard Routes....... *****************/
Route::prefix('')->namespace('Backend')->group(function() use ($route_base_path){
    Route::get('/','DashboardController@index')->name($route_base_path);
    Route::get('/dashboard','DashboardController@index')->name($route_base_path.'.dashboard');
    Route::get('/categories','CategoryController@index')->name($route_base_path.'.categories');
    Route::get('/subcategories','SubCategoryController@index')->name($route_base_path.'.subCategories');
    Route::get('/variants','VariantController@index')->name($route_base_path.'.variants');
    Route::get('/subvariants','SubVariantController@index')->name($route_base_path.'.subVariant');
    Route::get('/units','UnitController@index')->name($route_base_path.'.units');
    Route::get('/skus','SkuController@index')->name($route_base_path.'.skus');
    Route::prefix('/orders')->group(function() use ($route_base_path){
        Route::get('/','OrderController@index')->name($route_base_path.'.orders');
        Route::get('/create','OrderController@create')->name($route_base_path.'.orders.create');
        Route::get('/edit/{id}','OrderController@create')->name($route_base_path.'.orders.edit');
    });
    Route::get('/sales','SalesController@index')->name($route_base_path.'.sales');
    Route::get('/customers','CustomerController@index')->name($route_base_path.'.customers');
    Route::get('/products','ProductController@index')->name($route_base_path.'.products');
    Route::get('/offers','OfferController@index')->name($route_base_path.'.offers');
    Route::get('/tables','TableController@index')->name($route_base_path.'.tables');
    Route::get('/users','UserController@index')->name($route_base_path.'.users');
    Route::get('/settings','SettingsController@index')->name($route_base_path.'.settings');
});


/********** ......Backend Category Routes....... *****************/
//Route::prefix('/categories')->namespace('Backend')->group(function() use ($route_base_path){
//    Route::get('/','CategoryController@index')->name($route_base_path.'.categories');
//});
