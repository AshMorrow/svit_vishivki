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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::get('/', 'ShopController@main');
        Route::get('cart', 'CartController@show');
        Route::post('cart', 'CartController@create_order');

        Route::get('/category/{path}', 'CatalogController@show')->where('path', '.*?');
        Route::get('/product/{path}', 'ProductController@show');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
