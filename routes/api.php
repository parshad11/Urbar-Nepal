<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
		return $request->user();
	});*/

Route::namespace('Api')->middleware(['cors'])->group(function () {
    route::post('/login', 'LoginController@login')->name('delivery.login');
    route::post('ecommerce/login', 'EcommerceLoginController@login');
    route::post('/register', 'LoginController@register')->name('ecommerce.login');


    Route::middleware(['auth:api'])->group(function () {
        route::get('/delivery', 'DeliveryController@index');
        route::get('/delivery/{id}', 'DeliveryController@show');
        route::put('/delivery/{id}', 'DeliveryController@update');
        route::get('/delivery-people', 'DeliveryPersonController@GetAllDeliveryPeople');
        route::get('/task', 'TaskController@index');
        route::put('/task/{id}', 'TaskController@update');
        route::post('update/delivery/location', 'DeliveryPersonController@updateLocation');
    });
    /*Ecommerce*/
    Route::middleware(['auth:customerapi'])->group(function () {
        Route::get('/customer/profile', 'EcommerceLoginController@profile');
        Route::get('/shop/cart', 'CartController@index');
        Route::post('/shop/addtocart', 'CartController@addToCart');
        Route::get('/shop/remov-from-cart/{id}', 'CartController@removeFromCart');
        Route::get('/shop/checkout', 'ShopController@checkout');
        Route::post('/shop/checkout', 'ShopController@store');

    });
    route::get('/delivery/location/{id}', 'DeliveryPersonController@getLocation')->name('delivery.location');


});

//Non-Authenticated Routes
Route::get('/banners', 'Api\ShopController@banner');
Route::get('/products', 'Api\ProductController@products');
Route::get('featured/products', 'Api\ProductController@FeatureProduct');
Route::get('/product/search', 'Api\ProductController@search');
Route::get('/product/searchByCategroy/{id}', 'Api\ProductController@searchByCategory');
Route::get('/categories', 'Api\ProductController@categories');
Route::get('/popular/categories', 'Api\ProductController@PopularCategories');
Route::get('product/{slug}', 'Api\ProductController@product');
Route::get('variation/{slug}', 'Api\ProductController@variation');
