<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Sledgehammer', 'price' => 125.75],
            ['name' => 'Axe', 'price' => 190.50],
            ['name' => 'Bandsaw', 'price' => 562.131],
            ['name' => 'Chisel', 'price' => 12.9],
            ['name' => 'Hacksaw', 'price' => 18.45],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                ['price' => $product['price']]
            );
        }
    }
}
