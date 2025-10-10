<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            ['name' => 'Partner 1', 'logo' => 'assets/frontend/images/partner/light/1.png', 'link' => '#'],
            ['name' => 'Partner 2', 'logo' => 'assets/frontend/images/partner/light/2.png', 'link' => '#'],
            ['name' => 'Partner 3', 'logo' => 'assets/frontend/images/partner/light/3.png', 'link' => '#'],
            ['name' => 'Partner 4', 'logo' => 'assets/frontend/images/partner/light/4.png', 'link' => '#'],
            ['name' => 'Partner 5', 'logo' => 'assets/frontend/images/partner/light/5.png', 'link' => '#'],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
