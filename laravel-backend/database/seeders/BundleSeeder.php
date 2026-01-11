<?php

namespace Database\Seeders;

use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::take(5)->get();

        if ($products->count() >= 3) {
            $bundle = Bundle::create([
                'name' => 'Starter Bundle',
                'slug' => 'starter-bundle',
                'description' => 'Perfect bundle for beginners',
                'price' => 299.99,
                'sale_price' => 249.99,
                'is_active' => true,
            ]);

            // Attach products to bundle
            $bundle->products()->attach([
                $products[0]->id => ['quantity' => 1],
                $products[1]->id => ['quantity' => 2],
                $products[2]->id => ['quantity' => 1],
            ]);
        }
    }
}
