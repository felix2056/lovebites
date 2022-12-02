<?php

use Illuminate\Support\Facades\DB;
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
Route::get('db_dump', function () {
    /*
    Needed in SQL File:

    SET GLOBAL sql_mode = '';
    SET SESSION sql_mode = '';
    */
    $get_all_table_query = "SHOW TABLES";
    $result = DB::select(DB::raw($get_all_table_query));

    $tables = [
        'products'
    ];

    $structure = '';
    $data = '';
    foreach ($tables as $table) {
        $show_table_query = "SHOW CREATE TABLE " . $table . "";

        $show_table_result = DB::select(DB::raw($show_table_query));

        foreach ($show_table_result as $show_table_row) {
            $show_table_row = (array)$show_table_row;
            $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
        }
        $select_query = "SELECT * FROM " . $table;
        $records = DB::select(DB::raw($select_query));

        foreach ($records as $record) {
            $record = (array)$record;
            $table_column_array = array_keys($record);
            foreach ($table_column_array as $key => $name) {
                $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
            }

            $table_value_array = array_values($record);
            $data .= "\nINSERT INTO $table (";

            $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";

            foreach($table_value_array as $key => $record_column)
                $table_value_array[$key] = addslashes($record_column);

            $data .= "('" . implode("','", $table_value_array) . "');\n";
        }
    }
    $file_name = __DIR__ . '/../database/' . $table . '-' . date('y_m_d') . '.sql';
    $file_handle = fopen($file_name, 'w + ');

    $output = $structure . $data;
    fwrite($file_handle, $output);
    fclose($file_handle);
    echo "DB backup ready";
});

Route::get('retailer-price', function () {
    $products = \App\Product::all();
    foreach ($products as $product) {
        $product->retailer_original_price = $product->original_price;
        $product->retailer_sale_price = $product->sale_price;
        $product->save();
    }
    
    return response()->json([
        'status' => 'success',
        'products_count' => $products->count(),
        'message' => 'Successfully updated all products back to default price'
    ], 200);
});

Route::get('default-price', function () {
    $products = \App\Product::all();
    foreach ($products as $product) {
        $product->original_price = $product->retailer_original_price;
        $product->sale_price = $product->retailer_sale_price;
        $product->save();
    }
    
    return response()->json([
        'status' => 'success',
        'products_count' => $products->count(),
        'message' => 'Successfully updated all products back to default price'
    ], 200);
});

Route::get('increase-price/{percentage}', function ($percentage) {
    $products = \App\Product::all();
    foreach ($products as $product) {
        $product->original_price = $product->original_price + ($product->original_price * $percentage / 100);
        $product->sale_price = $product->sale_price + ($product->sale_price * $percentage / 100);
        $product->save();
    }
    
    return response()->json([
        'status' => 'success',
        'products_count' => $products->count(),
        'message' => 'Successfully increased all products price by ' . $percentage . '%'
    ], 200);
});

Route::get('decrease-price/{percentage}', function ($percentage) {
    $products = \App\Product::all();
    foreach ($products as $product) {
        $product->original_price = $product->original_price - ($product->original_price * $percentage / 100);
        $product->sale_price = $product->sale_price - ($product->sale_price * $percentage / 100);
        $product->save();
    }
    
    return response()->json([
        'status' => 'success',
        'products_count' => $products->count(),
        'message' => 'Successfully decreased all products price by ' . $percentage . '%'
    ], 200);
});

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

Route::prefix('categories')->group(function () {
    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/{slug}', 'CategoryController@show')->name('categories.show');
});

Route::prefix('subcategories')->group(function () {
    Route::get('/', 'SubCategoryController@index')->name('subcategories.index');
    Route::get('/{slug}', 'SubCategoryController@show')->name('subcategories.show');
});

Route::get('login', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@register')->name('register');

// dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::post('update-profile', 'DashboardController@updateProfile')->name('dashboard.update-profile');
        Route::post('update-billing', 'DashboardController@updateBilling')->name('dashboard.update-billing');

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
