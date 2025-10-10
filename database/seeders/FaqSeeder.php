<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What does this tool do?',
                'answer' => 'Online trading’s primary advantages are that it allows you to manage your trades at your convenience.',
                'order' => 1,
            ],
            [
                'question' => 'What are the disadvantages of online trading?',
                'answer' => 'You don’t need to worry, the interface is user-friendly. Anyone can use it smoothly. Our user manual will help you to solve your problem.',
                'order' => 2,
            ],
            [
                'question' => 'Is online trading safe?',
                'answer' => 'Online trading’s primary advantages are that it allows you to manage your trades at your convenience.',
                'order' => 3,
            ],
            [
                'question' => 'What is online trading, and how does it work?',
                'answer' => 'Online trading’s primary advantages are that it allows you to manage your trades at your convenience.',
                'order' => 4,
            ],
            [
                'question' => 'Which app is best for online trading?',
                'answer' => 'Online trading’s primary advantages are that it allows you to manage your trades at your convenience.',
                'order' => 5,
            ],
            [
                'question' => 'How to create a trading account?',
                'answer' => 'Online trading’s primary advantages are that it allows you to manage your trades at your convenience.',
                'order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
