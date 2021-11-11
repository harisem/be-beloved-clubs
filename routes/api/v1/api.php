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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth
Route::prefix('/auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('profile', 'AuthController@profile');
        Route::get('logout', 'AuthController@logout');
    });
});

// Cart
Route::prefix('/cart')->name('cart.')->group(function () {
    Route::get('', 'CartController@index')->name('index');
    Route::post('', 'CartController@store')->name('store');
    Route::get('/totalPrice', 'CartController@getCartTotalPrice')->name('totalPrice');
    Route::get('/totalWeight', 'CartController@getCartTotalWeight')->name('totalWeight');
    Route::post('/removeCart', 'CartController@removeCart')->name('removeCart');
    Route::post('/removeCarts', 'CartController@removeCarts')->name('removeCarts');
});

// Catalog
Route::prefix('/catalog')->name('catalog.')->group(function () {
    Route::get('', 'CatalogController@index')->name('index');
    Route::get('/{slug?}', 'CatalogController@show')->name('show');
    Route::get('/header', 'CatalogController@catalogsHeader')->name('header');
});

// Checkout
Route::prefix('/checkout')->name('checkout.')->group(function () {
    Route::post('', 'CheckoutController@store')->name('store');
    Route::post('/notificationHandler', 'CheckoutController@notificationHandler')->name('notificationHandler');
});

// Order
Route::prefix('/order')->name('order.')->group(function () {
    Route::get('', 'OrderController@index')->name('index');
    Route::get('/{snap_token?}', 'OrderController@show')->name('show');
});

// Product
Route::prefix('/product')->name('product.')->group(function () {
    Route::get('', 'ProductController@index')->name('index');
    Route::get('/{slug?}', 'ProductController@show')->name('show');
});

// RajaOngkir
Route::prefix('/ongkir')->name('ongkir.')->group(function () {
    Route::get('/provinces', 'RajaOngkirController@provinces')->name('provinces');
    Route::get('/cities', 'RajaOngkirController@cities')->name('cities');
    Route::post('/check', 'RajaOngkirController@ongkir')->name('checkOngkir');
});

// Slider
Route::prefix('/slider')->name('slider.')->group(function () {
    Route::get('', 'SliderController@index')->name('index');
});