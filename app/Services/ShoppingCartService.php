<?php

namespace App\Services;

use App\Product;

class ShoppingCartService
{
    /**
     * Save a product to the session, if the product already exists
     * increase its quantity by 1.
     *
     * @param Product $product Product details to store
     */
    public function addProduct(Product $product): void
    {
        if (session()->exists('shopping-cart')) {
            $shoppingCart = json_decode(session('shopping-cart'), true);


            if (array_key_exists($product['name'], $shoppingCart)) {
                $shoppingCart[$product['name']]['quantity'] += 1;
                $shoppingCart[$product['name']]['total'] = number_format(
                    $this->getItemTotal($product['price'], $shoppingCart[$product['name']]['quantity']),
                    2
                );
            } else {
                $shoppingCart[$product['name']] = [
                    'price' => number_format($product['price'], 2),
                    'quantity' => 1,
                    'total' => number_format($this->getItemTotal($product['price'], 1), 2),
                ];
            }
        } else {
            $shoppingCart = [
                $product['name'] => [
                    'price' => number_format($product['price'], 2),
                    'quantity' => 1,
                    'total' => number_format($this->getItemTotal($product['price'], 1), 2),
                ],
            ];
        }

        session(['shopping-cart' => json_encode($shoppingCart)]);
    }

    /**
     * Return all saved products from the session.
     *
     * @return array|null
     */
    public function getCart(): ?array
    {
        $shoppingCart = session('shopping-cart');

        return json_decode($shoppingCart, true);
    }

    /**
     * Remove a product from the session, if the product already
     * exists reduce its quantity by 1.
     *
     * @param string $product Name of the product to remove
     */
    public function removeProduct(string $product): void
    {
        if (session()->exists('shopping-cart')) {
            $shoppingCart = json_decode(session('shopping-cart'), true);

            if (array_key_exists($product, $shoppingCart)) {
                if ($shoppingCart[$product]['quantity'] > 1) {
                    $shoppingCart[$product]['quantity'] -= 1;
                    $shoppingCart[$product]['total'] = number_format(
                        $this->getItemTotal($shoppingCart[$product]['price'], $shoppingCart[$product]['quantity']),
                        2
                    );

                    session(['shopping-cart' => json_encode($shoppingCart)]);
                } else {
                    unset($shoppingCart[$product]);
                    session(['shopping-cart' => json_encode($shoppingCart)]);
                }
            }
        }
    }

    /**
     * Calculate the line total of all similar products.
     *
     * @param float $price
     * @param int $quantity
     *
     * @return float
     */
    public function getItemTotal(float $price, int $quantity): float
    {
        return $price * $quantity;
    }

    /**
     * Calculate the grand total of all products.
     *
     * @param array|null $shoppingCart
     *
     * @return float
     */
    public function getCartTotal(?array $shoppingCart): float
    {
        $total = 0;

        if (!empty($shoppingCart)) {
            foreach ($shoppingCart as $product) {
                $total += $product['total'];
            }
        }

        return $total;
    }
}
