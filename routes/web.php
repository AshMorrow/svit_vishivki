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

        Route::get('/category/{path}', 'CatalogController@show')->where('path', '.*?');
        Route::get('/product/{path}', 'ProductController@show');

        /**
         * Cart routes
         */
        Route::get('/cart', 'CartController@show');

        /**
         * Order routes
         */

        Route::post('/cart', 'OrderController@create');
        Route::get('/order-created', 'OrderController@success');




    });

Auth::routes();

Route::group(
  [
      "middleware" => ['isAdmin']
  ],
  function (){
      Route::get('/admin','AdminController@mainPage');
      //orders
      Route::get('/admin/orders','AdminOrdersController@getOrdersList');
      Route::get('/admin/orders/{id}','AdminOrdersController@orderDetails');
      Route::post('/admin/orders/{id}', 'AdminOrdersController@updateOrder');
      //products
      Route::get('/admin/products', 'AdminProductsController@getProductsList');
      Route::get('/admin/products/create', 'AdminProductsController@createPage');
      Route::post('/admin/products/create', 'AdminProductsController@create');
      //categories
      Route::get('/admin/categories', 'AdminCategoriesController@show');

      Route::get('/admin/logout', 'Auth\LoginController@logout');
  }
);
