<?php

namespace App\Services;

class ShoppingCartService
{
    public function addProduct($product)
    {
        $productData = [
            [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
            ]
        ];
        session(['shopping-cart' => json_encode($productData)]);
    }

    public function getCart()
    {
        $shoppingCart = session('shopping-cart');

        return json_decode($shoppingCart, true);
    }

    public function removeProduct()
    {
        session()->forget('shopping-cart');
    }
}
