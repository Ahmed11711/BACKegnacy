<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceCategories = Category::whereIn('slug', ['digital-marketing', 'web-design', 'branding'])->get();

        $services = [
            ['name' => 'SEO Optimization', 'description' => 'Improve your website search rankings', 'price' => 500, 'category_id' => $serviceCategories->where('slug', 'digital-marketing')->first()?->id],
            ['name' => 'Social Media Management', 'description' => 'Manage your social media presence', 'price' => 800, 'category_id' => $serviceCategories->where('slug', 'digital-marketing')->first()?->id],
            ['name' => 'Website Design', 'description' => 'Custom website design and development', 'price' => 2000, 'category_id' => $serviceCategories->where('slug', 'web-design')->first()?->id],
            ['name' => 'Logo Design', 'description' => 'Professional logo design', 'price' => 300, 'category_id' => $serviceCategories->where('slug', 'branding')->first()?->id],
            ['name' => 'Brand Identity', 'description' => 'Complete brand identity package', 'price' => 1500, 'category_id' => $serviceCategories->where('slug', 'branding')->first()?->id],
        ];

        foreach ($services as $service) {
            if ($service['category_id']) {
                Service::create(array_merge($service, ['is_active' => true, 'is_featured' => rand(0, 1)]));
            }
        }
    }
}
