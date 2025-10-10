<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'title' => 'Meet',
            'highlight' => 'our company',
            'subtitle' => 'unless miss the opportunity',
            'description' => "Hey there! So glad you stopped by to Meet Our Company. Don't miss out on this opportunity to learn about what we do and the amazing team that makes it all happen! Our company is all about creating innovative solutions and providing top-notch services to our clients. From start to finish, we're dedicated to delivering results that exceed expectations.",
            'button_text' => 'Explore More',
            'button_link' => '/about',
            'image' => 'assets/frontend/images/about/1.png',
            'exp_years_label' => 'Consulting Experience',
            'exp_years_value' => 30,
            'customers_label' => 'Satisfied Customers',
            'customers_value' => '25K+',
        ]);
    }
}
