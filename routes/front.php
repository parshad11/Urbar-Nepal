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
Route::get('/ecommerce/register','Auth\RegisterController@RegisterUserPage')->name('registerr_user');
Route::get('/ecommerce/login', 'Auth\LoginController@showCustomerLoginForm')->name('front_login');
Route::post('/ecommerce/login','Auth\RegisterController@store')->name('registerCustomer');
Route::post('/ecommerce/index', 'Auth\LoginController@customerLogin')->name('post_front_login');
Route::get('/ecommerce/logout', 'Auth\LoginController@customerLogout')->name('user.logout');

Route::namespace('Front')->group(function () {
    Route::get('/', 'FrontendController@index')->name('front_dashboard');
    Route::get('/shop/auto-complete', 'FrontendController@autoComplete')->name('autocomplete.search');

    Route::get('/latest-product', 'FrontendController@latestProduct')->name('latest_product');
    Route::get('/feature-product', 'FrontendController@featureProduct')->name('feature_product');
    Route::get('/about-us', 'FrontendController@getAbout')->name('front_about');
    Route::get('/blogs', 'FrontendController@getBlog')->name('blog');
    Route::get('/contact-us', 'FrontendController@getContact')->name('contact');
    Route::get('/blog/single/{slug}', 'FrontendController@getSingleBlog')->name('blog_single');
    Route::post('/vendor/request', 'FrontendController@mailRequest')->name('vendor.request');
    Route::get('/faqs', 'FrontendController@getFaqs')->name('faqs');
    // Route::get('/buy-sell', 'FrontendController@getBuyOrSell')->name('buy_sell');
    // Route::get('/careers', 'FrontendController@getCareers')->name('careers');

    // E-commerce Routes
    Route::get('/category/{slugg}/{idd}','ShopController@Show_category_list')->name('categories_product_list');
    Route::get('/sub-catagories/{slug}/{id}', 'ShopController@sub_category_Product')->name('product_sub_category');
    Route::get('/all-category','ShopController@showAllCategory')->name('show_all_category');



    Route::get('/shop/cart-item', 'CartController@updateNavCart')->name('cart.nav_cart');
    Route::get('/shop/remov-from-cart', 'CartController@removeFromCart')->name('removefromcart')->middleware('auth:customer');
    Route::get('/shop/addtocart', 'CartController@addToCart')->name('addtocart')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::post('/shop/buy-now', 'CartController@buyNow')->name('product_buy_now')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::get('/shop/cart', 'CartController@index')->name('product.cart')->middleware(['auth:customer','SetCustomerSessionData']);


    Route::get('/shop/user-account', 'ShopController@getCustomer')->name('customer.account')->middleware('auth:customer');
    Route::get('/shop/user-account-edit/{id}', 'ShopController@getCustomerEdit')->name('customer.account_edit')->middleware('auth:customer');
    Route::post('/shop/user-account-update/{id}', 'ShopController@getCustomerUpdate')->name('customer.account_update')->middleware('auth:customer');
    Route::get('/shop/checkout', 'ShopController@checkout')->name('product.checkout')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::post('/shop/checkout', 'ShopController@store')->name('order.store')->middleware(['auth:customer','SetCustomerSessionData']);
    Route::get('/shop/category/{slug}', 'ShopController@categoryProduct')->name('product_category');
    Route::get('/shop/category/{slug}/{sub_slug}', 'ShopController@subcategoryProduct')->name('product_subcategory');
    // Route::get('/', 'ShopController@index')->name('front_dashboard');
    Route::get('/shop', 'ShopController@index')->name('shop');
    Route::get('/shop/auto-complete', 'ShopController@autoComplete')->name('autocomplete.search');

    Route::get('/shop/product/{slug}', 'ShopController@product')->name('product_single');
    Route::get('/download/file/{fileId}', 'ShopController@downloadFile')->name('downloadfile');


    Route::get('/{slug}', 'FrontendController@getPages')->name('pages');

});
