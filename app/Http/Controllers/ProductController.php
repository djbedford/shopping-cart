<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController
{
    /**
     * Display a listing of all the available products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }
}
