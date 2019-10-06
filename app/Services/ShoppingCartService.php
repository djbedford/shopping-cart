<?php

namespace App\Services;

class ShoppingCartService
{
    public function addProduct($product)
    {
        if (session()->exists('shopping-cart')) {
            $shoppingCart = json_decode(session('shopping-cart'), true);

            if (array_key_exists($product['name'], $shoppingCart)) {
                $shoppingCart[$product['name']]['quantity'] += 1;
                $shoppingCart[$product['name']]['total'] = $this->getItemTotal($product['price'], $shoppingCart[$product['name']]['quantity']);

                session(['shopping-cart' => json_encode($shoppingCart)]);
            } else {
                $shoppingCart[$product['name']] = [
                    'price' => number_format($product['price'], 2),
                    'quantity' => 1,
                    'total' => $this->getItemTotal($product['price'], 1),
                ];

                session(['shopping-cart' => json_encode($shoppingCart)]);
            }
        } else {
            $shoppingCart = [
                $product['name'] => [
                    'price' => number_format($product['price'], 2),
                    'quantity' => 1,
                    'total' => $this->getItemTotal($product['price'], 1),
                ],
            ];

            session(['shopping-cart' => json_encode($shoppingCart)]);
        }
    }

    public function getCart(): ?array
    {
        $shoppingCart = session('shopping-cart');

        return json_decode($shoppingCart, true);
    }

    public function removeProduct($product)
    {
        if (session()->exists('shopping-cart')) {
            $shoppingCart = json_decode(session('shopping-cart'), true);

            if (array_key_exists($product, $shoppingCart)) {
                if ($shoppingCart[$product]['quantity'] > 1) {
                    $shoppingCart[$product]['quantity'] -= 1;
                    $shoppingCart[$product]['total'] = $this->getItemTotal($shoppingCart[$product]['price'], $shoppingCart[$product]['quantity']);

                    session(['shopping-cart' => json_encode($shoppingCart)]);
                } else {
                    unset($shoppingCart[$product]);
                    session(['shopping-cart' => json_encode($shoppingCart)]);
                }
            }
        }
    }

    public function getItemTotal(float $price, int $quantity): float
    {
        return number_format($price * $quantity, 2);
    }

    public function getCartTotal(array $shoppingCart): float
    {
        $total = 0;

        foreach ($shoppingCart as $product) {
            $total += $product['total'];
        }

        return number_format($total, 2);
    }
}
