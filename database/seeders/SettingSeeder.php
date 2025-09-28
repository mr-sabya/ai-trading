<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::firstOrCreate([], [ // Ensure only one record exists
            'website_name' => 'My Awesome Website',
            'tagline' => 'The best place for your needs',
            'light_logo' => null, // You can set default image paths if you want
            'dark_logo' => null,
            'favicon' => null,
            'copyright' => '© ' . date('Y') . ' My Awesome Website',
            'short_description' => 'Short description of website',
            'phone' => '+880123456789',
            'email' => 'info@example.com',
            'address' => 'Dhaka, Bangladesh',
            'facebook' => 'https://facebook.com/',
            'instagram' => 'https://instagram.com/',
            'linkedin' => 'https://linkedin.com/',
            'youtube' => 'https://youtube.com/',
            'twitter' => 'https://twitter.com/',
        ]);
    }
}
