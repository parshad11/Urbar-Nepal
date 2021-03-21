<?php

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register front routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/shop/login', 'Auth\LoginController@showCustomerLoginForm')->name('front_login');
Route::post('/shop/login', 'Auth\LoginController@customerLogin')->name('post_front_login');
Route::get('/shop/logout', 'Auth\LoginController@customerLogout')->name('user.logout');

Route::namespace('Front')->group(function () {
    Route::get('/', 'FrontendController@index')->name('front_dashboard');
    Route::get('/about-us', 'FrontendController@getAbout')->name('front_about');
    Route::get('/blog', 'FrontendController@getBlog')->name('blog');
    Route::get('/blog/{slug}', 'FrontendController@getSingleBlog')->name('blog_single');
    Route::get('/team', 'FrontendController@getTeam')->name('teams');
    Route::get('/contact', 'FrontendController@getContact')->name('contact');
    Route::post('/vendor/request', 'FrontendController@mailRequest')->name('vendor.request');
    Route::get('/faqs', 'FrontendController@getFaqs')->name('faqs');
    Route::get('/buy-sell', 'FrontendController@getBuyOrSell')->name('buy_sell');
    Route::get('/careers', 'FrontendController@getCareers')->name('careers');

    // E-commerce Routes
    Route::get('/shop/cart-item', 'CartController@updateNavCart')->name('cart.nav_cart');
    Route::get('/shop/remov-from-cart', 'CartController@removeFromCart')->name('removefromcart')->middleware('auth:customer');
    Route::get('/shop/addtocart', 'CartController@addToCart')->name('addtocart')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::get('/shop/cart', 'CartController@index')->name('product.cart')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::get('/shop/checkout', 'ShopController@checkout')->name('product.checkout')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::post('/shop/checkout', 'ShopController@store')->name('order.store')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::get('/shop/category/{slug}', 'ShopController@categoryProduct')->name('product_category');
    Route::get('/shop/category/{slug}/{sub_slug}', 'ShopController@subcategoryProduct')->name('product_subcategory');
    Route::get('/shop', 'ShopController@index')->name('shop');
    
    Route::get('/shop/product/{slug}', 'ShopController@product')->name('product_single');


    Route::get('/{slug}', 'FrontendController@getPages')->name('pages');
});
