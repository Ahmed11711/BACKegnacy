<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create parent categories
        $parentCategories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'is_active' => true],
            ['name' => 'Clothing', 'slug' => 'clothing', 'is_active' => true],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'is_active' => true],
        ];

        foreach ($parentCategories as $category) {
            Category::create($category);
        }

        // Create child categories
        $electronics = Category::where('slug', 'electronics')->first();
        if ($electronics) {
            Category::create([
                'name' => 'Smartphones',
                'slug' => 'smartphones',
                'parent_id' => $electronics->id,
                'is_active' => true,
            ]);
            Category::create([
                'name' => 'Laptops',
                'slug' => 'laptops',
                'parent_id' => $electronics->id,
                'is_active' => true,
            ]);
        }

        // Create service categories
        Category::create(['name' => 'Digital Marketing', 'slug' => 'digital-marketing', 'is_active' => true]);
        Category::create(['name' => 'Web Design', 'slug' => 'web-design', 'is_active' => true]);
        Category::create(['name' => 'Branding', 'slug' => 'branding', 'is_active' => true]);
    }
}
