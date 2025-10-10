<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'heading' => 'Invest your money with',
            'highlight' => 'higher return',
            'description' => 'Anyone can invest money to different currency to increase their earnings by the help of Bitrader through online.',
            'button_text' => 'Get Started',
            'button_link' => '/signin',
            'video_link' => 'https://www.youtube.com/watch?v=MHhIzIgFgJo',
            'image' => 'assets/frontend/images/banner/home1/1.png',
            'background_image' => 'assets/frontend/images/banner/home1/bg.png',
        ]);
    }
}
