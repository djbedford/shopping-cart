<?php

namespace Tests\Unit;

use App\Product;
use App\Services\ShoppingCartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    /** @test */
    public function it_has_a_total_per_item()
    {
        $product = [
            'name' => 'Axe',
            'price' => 190.50,
            'quantity' => 1,
            'total' => 190.50,
        ];

        $shoppingCartService = new ShoppingCartService;

        $this->assertEquals(190.50, $shoppingCartService->getItemTotal($product['price'], 1));
        $this->assertEquals(381.00, $shoppingCartService->getItemTotal($product['price'], 2));
    }

    /** @test */
    public function it_has_an_overall_total()
    {
        $shoppingCart = [
            'Axe' => [
                'price' => 190.50,
                'quantity' => 1,
                'total' => 190.50,
            ],
            'Chisel' => [
                'price' => 12.90,
                'quantity' => 2,
                'total' => 25.80,
            ],
        ];

        $shoppingCartService = new ShoppingCartService;

        $this->assertEquals(216.30, $shoppingCartService->getCartTotal($shoppingCart));
    }

    /** @test */
    public function it_can_add_a_product()
    {
        $product = factory(Product::class)->make([
            'name' => 'Axe',
            'price' => 190.50,
            'quantity' => 1,
            'total' => 190.50,
        ]);

        $shoppingCartService = new ShoppingCartService;
        $shoppingCartService->addProduct($product);

        $cart = $shoppingCartService->getCart();

        $this->assertArrayHasKey('Axe', $cart);
    }

    /** @test */
    public function it_can_remove_a_product()
    {
        $product = factory(Product::class)->make([
            'name' => 'Axe',
            'price' => 125.75,
            'quantity' => 1,
            'total' => 125.75,
        ]);

        $shoppingCartService = new ShoppingCartService;
        $shoppingCartService->addProduct($product);
        $shoppingCartService->removeProduct('Axe');

        $cart = $shoppingCartService->getCart();

        $this->assertArrayNotHasKey('Axe', $cart);
    }

    /** @test */
    public function it_can_store_multiple_products()
    {
        $product1 = factory(Product::class)->make([
            'name' => 'Axe',
            'price' => 190.50,
            'quantity' => 1,
            'total' => 190.50,
        ]);

        $product2 = factory(Product::class)->make([
            'name' => 'Sledgehammer',
            'price' => 125.75,
            'quantity' => 1,
            'total' => 125.75,
        ]);

        $shoppingCartService = new ShoppingCartService;
        $shoppingCartService->addProduct($product1);
        $shoppingCartService->addProduct($product2);
        $shoppingCartService->addProduct($product2);

        $cart = $shoppingCartService->getCart();

        $this->assertCount(2, $cart);
        $this->assertEquals(2, $cart['Sledgehammer']['quantity']);
    }
}
