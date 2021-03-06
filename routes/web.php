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
});