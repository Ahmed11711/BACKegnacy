<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::whereNull('parent_id')->get();

        foreach ($categories as $category) {
            Product::factory(5)->create([
                'category_id' => $category->id,
                'is_active' => true,
            ]);
        }

        // Create featured products
        Product::factory(3)->create([
            'is_featured' => true,
            'is_active' => true,
        ]);
    }
}
