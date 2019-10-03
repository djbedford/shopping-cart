<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ShoppingCartService;

class ShoppingCartController
{
    /**
     * @var ShoppingCartService
     */
    private $shoppingCartService;

    public function __construct(ShoppingCartService $shoppingCartService)
    {
        $this->shoppingCartService = $shoppingCartService;
    }

    public function index()
    {
        $shoppingCart = $this->shoppingCartService->getCart();

        return view('shopping-cart', ['cart' => $shoppingCart]);
    }

    public function store($productName)
    {
        $product = Product::where('name', '=', ucfirst($productName))->get()->first();

        $this->shoppingCartService->addProduct($product);

        return redirect('/products');
    }

    public function destroy($productName)
    {
        $this->shoppingCartService->removeProduct();

        return redirect('/shopping-cart');
    }
}
