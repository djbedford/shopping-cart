<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/products', [ProductController::class, 'index']);

Route::get('/shopping-cart', [ShoppingCartController::class, 'index']);
Route::post('/shopping-cart/{product}', [ShoppingCartController::class, 'store']);
Route::delete('/shopping-cart/{product}', [ShoppingCartController::class, 'destroy']);

/** Redirect any un-handled requests back to the products page */
Route::get('/{any}', function () {
    return redirect('/products');
})->where('any', '.*');
