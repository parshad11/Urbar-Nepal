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
	// route::post('/login', 'LoginController@ecommerceLogin')->name('ecommerce.login');



	Route::middleware(['auth:api'])->group(function () {
		route::get('/delivery', 'DeliveryController@index');
		route::put('/delivery/{id}', 'DeliveryController@update');
		route::get('/delivery-people', 'DeliveryPersonController@GetAllDeliveryPeople');
		route::get('/task', 'TaskController@index');
		route::put('/task/{id}', 'TaskController@update');
	});
	/*Ecommerce*/
	Route::middleware(['auth:customerapi'])->group(function () {
		Route::get('/customer/profile','EcommerceLoginController@profile');
		Route::get('/shop/cart', 'CartController@index');
		Route::post('/shop/addtocart', 'CartController@addToCart');
		Route::get('/shop/remov-from-cart/{id}', 'CartController@removeFromCart');
		Route::get('/shop/checkout', 'ShopController@checkout');
		Route::post('/shop/checkout', 'ShopController@store');
	});
	route::get('/delivery/location', 'DeliveryPersonController@getLocation')->name('delivery.location');
	route::post('/delivery_person/track/{id}', 'DeliveryPersonController@getDeliveryPersonLocation')
		->name('delivery.track');




});

//Non-Authenticated Routes
Route::get('/documents', 'Api\ShopController@documents');
Route::get('/download/file/{fileId}', 'ShopController@downloadFile')->name('downloadfile');
Route::get('/products', 'Api\ProductController@products');
Route::get('/categories', 'Api\ProductController@categories');
Route::get('product/{slug}', 'Api\ProductController@product');
Route::get('variation/{slug}', 'Api\ProductController@variation');
