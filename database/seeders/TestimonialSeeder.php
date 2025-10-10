<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Mobarok Hossain',
                'designation' => 'Trade Master',
                'image' => 'assets/frontend/images/testimonial/1.png',
                'message' => 'The above testimonial is about Martha Chumo, who taught herself to code in one summer. This testimonial example works because it allows prospective customers to see themselves in Codeacademy’s current customer base.',
            ],
            [
                'name' => 'Guy Hawkins',
                'designation' => 'Trade Boss',
                'image' => 'assets/frontend/images/testimonial/2.png',
                'message' => 'In the above testimonial, a customer named Jeanine shares her experience with Briogeo’s products. While the post is scattered with too many product mentions, it takes full advantage of its real estate by allowing the writer to tell.',
            ],
            [
                'name' => 'Belal Hossain',
                'designation' => 'Trade Genius',
                'image' => 'assets/frontend/images/testimonial/6.png',
                'message' => 'The above testimonial is about Martha Chumo, who taught herself to code in one summer. This testimonial example works because it allows prospective customers to see themselves in Codeacademy’s current customer base.',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
