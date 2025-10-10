<?php

namespace Database\Seeders;

use App\Models\WebsiteFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteFeature::insert([
            [
                'title' => 'Lending money for investment of your new projects',
                'description' => 'Unlock the full potential of our product with our amazing features and top-notch service.',
                'tab_title' => 'Lending Money',
                'main_image' => 'assets/frontend/images/feature/1.png',
                'floating_top_image' => 'assets/frontend/images/feature/5.png',
                'floating_top_text' => 'Interest Rate For Loan',
                'floating_bottom_number' => '10M',
                'floating_bottom_text' => 'Available for loan',
            ],
            [
                'title' => 'More security and control over money from the rest',
                'description' => 'Experience seamless control and transparency with top-tier financial tools.',
                'tab_title' => 'Security & Control',
                'main_image' => 'assets/frontend/images/feature/2.png',
                'floating_top_image' => 'assets/frontend/images/feature/6.png',
                'floating_top_text' => 'Interest Rate For Loan',
                'floating_bottom_number' => '18M',
                'floating_bottom_text' => 'Available for loan',
            ],
            [
                'title' => 'Mobile payment is more flexible and easy for all investors',
                'description' => 'Enjoy a smooth, mobile-first experience that keeps you in control anywhere.',
                'tab_title' => 'Mobile Payment',
                'main_image' => 'assets/frontend/images/feature/1.png',
                'floating_top_image' => 'assets/frontend/images/feature/7.png',
                'floating_top_text' => 'Interest Rate For Loan',
                'floating_bottom_number' => '30M',
                'floating_bottom_text' => 'Available for loan',
            ],
            [
                'title' => 'All transactions are kept free for members of Pro Traders',
                'description' => 'Get exclusive benefits and zero transaction fees as a Pro Trader member.',
                'tab_title' => 'Free Transactions',
                'main_image' => 'assets/frontend/images/feature/2.png',
                'floating_top_image' => 'assets/frontend/images/feature/8.png',
                'floating_top_text' => 'Interest Rate For Loan',
                'floating_bottom_number' => '28M',
                'floating_bottom_text' => 'Available for loan',
            ],
        ]);
    }
}
