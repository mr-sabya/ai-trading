<?php

use App\Models\User;
use App\Models\ReferralGeneration;
use App\Models\Setting;

if (!function_exists('getUserGenerations')) {
    /**
     * Get all referrers (generations) for a given user.
     *
     * @param User $user
     * @param float|null $amount Optional amount to calculate commission
     * @param int $maxGenerations Maximum generations to fetch
     * @return array
     */
    function getUserGenerations(User $user, $amount = null, $maxGenerations = 32)
    {
        $generations = [];
        $currentUser = $user;
        $generationNumber = 1;

        while ($currentUser->referrer && $generationNumber <= $maxGenerations) {
            $referrer = $currentUser->referrer;

            $genData = ReferralGeneration::where('generation', $generationNumber)->first();
            $percent = $genData ? $genData->commission_percent : 0;

            $commissionAmount = $amount ? ($amount * $percent / 100) : null;

            $generations[] = [
                'generation' => $generationNumber,
                'referrer_id' => $referrer->id,
                'referrer_name' => $referrer->name,
                'commission_percent' => $percent,
                'commission_amount' => $commissionAmount,
            ];

            $currentUser = $referrer;
            $generationNumber++;
        }

        return $generations;
    }
}


if (! function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $settings = null;

        if ($settings === null) {
            $settings = Setting::first()?->toArray() ?? [];
        }

        return $settings[$key] ?? $default;
    }
}
