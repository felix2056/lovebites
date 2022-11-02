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

Route::get('/', 'HomeController@index')->name('home');
Route::get('about-us', 'HomeController@about')->name('about');
Route::get('contact-us', 'HomeController@contact')->name('contact');
Route::get('wishlist', 'HomeController@wishlist')->name('wishlist');

Route::get('login', 'AuthController@login')->name('login');

Route::prefix('products')->group(function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/product', 'ProductController@show')->name('products.show');
});
