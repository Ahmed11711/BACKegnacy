<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Media Agency Elite', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'A high-end, cinematic media agency', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'info@example.com', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '+1 234 567 8900', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'appearance'],
            ['key' => 'hero_title', 'value' => 'Crafting Legendary Brand Experiences', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'hero_subtitle', 'value' => 'Transforming ideas into powerful brand experiences', 'type' => 'textarea', 'group' => 'appearance'],
            ['key' => 'default_language', 'value' => 'en', 'type' => 'text', 'group' => 'general'],
            ['key' => 'default_theme', 'value' => 'dark', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'facebook_url', 'value' => null, 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => null, 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => null, 'type' => 'text', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
