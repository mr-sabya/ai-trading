<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Strategy Consulting',
                'slug' => 'strategy-consulting',
                'image' => 'assets/frontend/images/service/1.png',
                'description' => 'A social assistant that\'s flexible can accommodate your schedule and needs, making life easier.',
                'order' => 1,
            ],
            [
                'title' => 'Financial Advisory',
                'slug' => 'financial-advisory',
                'image' => 'assets/frontend/images/service/2.png',
                'description' => 'Modules transform smart trading by automating processes and improving decision-making.',
                'order' => 2,
            ],
            [
                'title' => 'Management',
                'slug' => 'management',
                'image' => 'assets/frontend/images/service/3.png',
                'description' => 'Your friendly neighborhood reporter’s news analyst processes and improving.',
                'order' => 3,
            ],
            [
                'title' => 'Supply Optimization',
                'slug' => 'supply-optimization',
                'image' => 'assets/frontend/images/service/4.png',
                'description' => 'A cool and easy-to-use cryptocurrency platform for all users.',
                'order' => 4,
            ],
            [
                'title' => 'HR Consulting',
                'slug' => 'hr-consulting',
                'image' => 'assets/frontend/images/service/5.png',
                'description' => 'Updates on exchange orders and currency management.',
                'order' => 5,
            ],
            [
                'title' => 'Marketing Consulting',
                'slug' => 'marketing-consulting',
                'image' => 'assets/frontend/images/service/6.png',
                'description' => 'Price notification module processes are now live!',
                'order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
