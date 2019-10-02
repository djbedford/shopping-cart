<?php

namespace App\Services;

class ShoppingCartService
{
    public function addProduct($product)
    {
        session(['shopping-cart' => json_encode($product)]);
    }

    public function getCart()
    {
        $shoppingCart = session('shopping-cart');

        return json_decode($shoppingCart, true);
    }
}
