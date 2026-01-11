<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'short_description' => fake()->sentence(),
            'sku' => fake()->unique()->bothify('SKU-#####'),
            'price' => fake()->randomFloat(2, 10, 1000),
            'sale_price' => fake()->optional()->randomFloat(2, 5, 800),
            'stock_quantity' => fake()->numberBetween(0, 100),
            'stock_status' => fake()->randomElement(['in_stock', 'out_of_stock', 'on_backorder']),
            'images' => null,
            'category_id' => Category::factory(),
            'is_featured' => false,
            'is_active' => true,
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
