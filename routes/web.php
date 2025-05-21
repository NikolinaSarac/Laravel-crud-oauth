<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductController;
use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('customers', CustomersController::class);

Route::resource('products', ProductController::class);

Route::resource('categories', CategoryController::class);

Route::resource('colors', ColorController::class);

Route::get('/api-proba', function () {
    return 'Radi web!';
});




