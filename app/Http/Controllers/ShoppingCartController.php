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

    /**
     * Get a list of all products stored in the shopping cart
     * and display them to the user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shoppingCart = $this->shoppingCartService->getCart();
        $shoppingCartTotal = number_format($this->shoppingCartService->getCartTotal($shoppingCart), 2);

        return view('shopping-cart', ['cart' => $shoppingCart, 'cartTotal' => $shoppingCartTotal]);
    }

    /**
     * Save a product to the shopping cart.
     *
     * @param $productName
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($productName)
    {
        $product = Product::where('name', '=', ucfirst($productName))->get()->first();

        $this->shoppingCartService->addProduct($product);

        return redirect('/products');
    }

    /**
     * Remove a product from the shopping cart.
     *
     * @param $productName
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($productName)
    {
        $this->shoppingCartService->removeProduct(ucfirst($productName));

        return redirect('/shopping-cart');
    }
}
