<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $team = [
            [
                'name' => 'Dianne Russell',
                'slug' => 'dianne-russell',
                'designation' => 'Trade Captain',
                'image' => 'assets/frontend/images/team/1.png',
                'order' => 1,
            ],
            [
                'name' => 'Theresa Webb',
                'slug' => 'theresa-webb',
                'designation' => 'Strategic Advisor',
                'image' => 'assets/frontend/images/team/2.png',
                'order' => 2,
            ],
            [
                'name' => 'Courtney Henry',
                'slug' => 'courtney-henry',
                'designation' => 'Management Consultant',
                'image' => 'assets/frontend/images/team/3.png',
                'order' => 3,
            ],
            [
                'name' => 'Albert Flores',
                'slug' => 'albert-flores',
                'designation' => 'Development Specialist',
                'image' => 'assets/frontend/images/team/4.png',
                'order' => 4,
            ],
            [
                'name' => 'Darrell Steward',
                'slug' => 'darrell-steward',
                'designation' => 'Growth Strategist',
                'image' => 'assets/frontend/images/team/5.png',
                'order' => 5,
            ],
            [
                'name' => 'Wade Warren',
                'slug' => 'wade-warren',
                'designation' => 'Trade Consultant',
                'image' => 'assets/frontend/images/team/6.png',
                'order' => 6,
            ],
            [
                'name' => 'Cody Fisher',
                'slug' => 'cody-fisher',
                'designation' => 'HR Consultant',
                'image' => 'assets/frontend/images/team/7.png',
                'order' => 7,
            ],
            [
                'name' => 'Bessie Cooper',
                'slug' => 'bessie-cooper',
                'designation' => 'Financial Advisor',
                'image' => 'assets/frontend/images/team/8.png',
                'order' => 8,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::create($member);
        }
    }
}
