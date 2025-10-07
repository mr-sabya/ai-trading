<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $user;
    public $userId;
    public $generations = [];
    public $totalReferrals = 0;
    public $totalWithdraw = 0;
    public $totalCommission = 0;

    public function mount($id)
    {
        $this->userId = $id;

        $this->user = User::with([
            'referrer',
            'referrals',
            'purchases.package',
            'purchases.histories',
            'purchases.referralCommissions.referredUser',
            'withdraws',
        ])->findOrFail($id);

        // Use helper to get dynamic generation chain
        $this->generations = getUserGenerations($this->user);

        // Totals
        $this->totalReferrals = $this->user->referrals->count();
        $this->totalWithdraw = $this->user->withdraws->sum('amount');
        $this->totalCommission = $this->user->referralCommissions()->sum('amount');
    }

    public function render()
    {
        return view('livewire.backend.user.show');
    }
}
