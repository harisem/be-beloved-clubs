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

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/', function () {
        return view('index');
    })->name('dashboard');

    // Employees Management
    Route::middleware('role:owner')->group(function () {
        Route::resource('/users', 'UsersController');
    });

    // Catalogs Management
    Route::prefix('catalogs')->name('catalogs.')->group(function () {
        Route::get('/', 'CatalogController@index')->name('index')->middleware('permission:read catalogs');
        Route::post('/', 'CatalogController@store')->name('store')->middleware('permission:create catalogs');
        Route::get('create', 'CatalogController@create')->name('create')->middleware('permission:create catalogs');
        Route::get('{catalog}/edit', 'CatalogController@edit')->name('edit')->middleware('permission:update catalogs');
        Route::delete('{catalog}', 'CatalogController@destroy')->name('destroy')->middleware('permission:delete catalogs');
        Route::match(['put', 'patch'], '{catalog}', 'CatalogController@update')->name('update')->middleware('permission:update catalogs');
    });

    // Warehouses Management
    Route::prefix('warehouses')->name('warehouses.')->group(function () {
        Route::get('/', 'WarehouseController@index')->name('index')->middleware('permission:read warehouses');
        Route::post('/', 'WarehouseController@store')->name('store')->middleware('permission:create warehouses');
        Route::get('create', 'WarehouseController@create')->name('create')->middleware('permission:create warehouses');
        Route::get('{warehouse}/edit', 'WarehouseController@edit')->name('edit')->middleware('permission:update warehouses');
        Route::delete('{warehouse}', 'WarehouseController@destroy')->name('destroy')->middleware('permission:delete warehouses');
        Route::match(['put', 'patch'], '{warehouse}', 'WarehouseController@update')->name('update')->middleware('permission:update warehouses');
    });
    
    // Products Management
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index')->middleware('permission:read products');
        Route::post('/', 'ProductController@store')->name('store')->middleware('permission:create products');
        Route::get('{product}/create', 'ProductController@create')->name('create')->middleware('permission:create products');
        Route::get('{product}/edit', 'ProductController@edit')->name('edit')->middleware('permission:update products');
        Route::delete('{product}', 'ProductController@destroy')->name('destroy')->middleware('permission:delete products');
        Route::match(['put', 'patch'], '{product}', 'ProductController@update')->name('update')->middleware('permission:update products');
    });
    
    // Sliders Management
    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/', 'SliderController@index')->name('index')->middleware('permission:read sliders');
        Route::post('/', 'SliderController@store')->name('store')->middleware('permission:create sliders');
        Route::get('{slider}/edit', 'SliderController@edit')->name('edit')->middleware('permission:update sliders');
        Route::delete('{slider}', 'SliderController@destroy')->name('destroy')->middleware('permission:delete sliders');
        Route::match(['put', 'patch'], '{slider}', 'SliderController@update')->name('update')->middleware('permission:update sliders');
    });
});