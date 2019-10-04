<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    /** @test  */
    public function it_can_store_a_product()
    {
        $response = $this->json('POST', '/shopping-cart/sledgehammer');

        $response
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertSessionHas('shopping-cart');
    }

    /** @test */
    public function it_can_delete_products()
    {
        $response = $this->json('DELETE', '/shopping-cart/sledgehammer');

        $response
            ->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertSessionMissing('shopping-cart');
    }
}
