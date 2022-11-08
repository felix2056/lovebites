<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('index');
Route::get('about-us', 'HomeController@about')->name('about');
Route::get('contact-us', 'HomeController@contact')->name('contact');
Route::get('wishlist', 'HomeController@wishlist')->name('wishlist');

Route::get('cart', 'HomeController@cart')->name('cart');
Route::get('checkout', 'HomeController@checkout')->name('checkout');
// only for Stripe Payment Flow or Stripe Elements
Route::get('checkout-payment', 'HomeController@checkoutPayment')->name('checkout.payment');

Route::prefix('stripe')->group(function () {
    Route::post('create', 'StripeController@create')->name('stripe.create');
    Route::post('store', 'StripeController@store')->name('stripe.store');

    Route::post('checkout', 'StripeController@checkoutWithElements')->name('stripe.checkout');
    // Route::post('checkout', 'StripeController@checkoutWithCheckout')->name('stripe.checkout');

    Route::get('checkout/success', 'StripeController@success')->name('stripe.success');
    Route::get('checkout/cancel', 'StripeController@cancel')->name('stripe.cancel');
});

Route::prefix('products')->group(function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/{slug}', 'ProductController@show')->name('products.show');
    Route::get('/{slug}/quick-view', 'ProductController@quickview')->name('products.quick-view');

    Route::get('/{slug}/add-to-cart', 'ProductController@addToCart')->name('products.add-to-cart');
    Route::get('/{slug}/remove-from-cart', 'ProductController@removeFromCart')->name('products.remove-from-cart');
});

Route::get('login', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@register')->name('register');

// dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::get('orders', 'DashboardController@orders')->name('dashboard.orders');
        Route::get('orders/{id}', 'DashboardController@order')->name('dashboard.order');
        Route::get('addresses', 'DashboardController@addresses')->name('dashboard.addresses');
        Route::get('addresses/create', 'DashboardController@createAddress')->name('dashboard.addresses.create');
        Route::post('addresses/store', 'DashboardController@storeAddress')->name('dashboard.addresses.store');
        Route::get('addresses/{id}/edit', 'DashboardController@editAddress')->name('dashboard.addresses.edit');
        Route::post('addresses/{id}/update', 'DashboardController@updateAddress')->name('dashboard.addresses.update');
        Route::get('addresses/{id}/delete', 'DashboardController@deleteAddress')->name('dashboard.addresses.delete');
    });
});
