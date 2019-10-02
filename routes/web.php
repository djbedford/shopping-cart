<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/products', [ProductController::class, 'index']);

Route::get('/shopping-cart', [ShoppingCartController::class, 'index']);
Route::post('/shopping-cart/{product}', [ShoppingCartController::class, 'store']);
