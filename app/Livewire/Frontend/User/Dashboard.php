<?php

namespace App\Livewire\Frontend\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Dashboard extends Component
{
    public User $user;
    /** @var \Illuminate\Support\Collection */
    public $packages;
    public $totalReferrals = 0;
    public $referralEarnings = 0;
    public $activePackages = 0;
    public $totalWithdraw = 0;
    public $generations = [];
    public $referrals = [];
    public $withdraws = [];

    public function mount()
    {
        $this->user = Auth::user();

        $this->totalReferrals = $this->user->referrals->count();
        $this->referralEarnings = $this->user->referralCommissions()->sum('amount');
        $this->totalWithdraw = $this->user->withdraws->sum('amount');

        // Active packages
        $this->packages = $this->user->purchases()->with('package')->get()->map(function ($purchase) {
            return (object) [
                'name' => $purchase->package?->name ?? '-',
                'billing_cycle' => $purchase->package?->billing_cycle ?? '-',
                'first_price' => $purchase->first_price,
                'renew_price' => $purchase->renew_price,
                'is_active' => $purchase->isActive(),
            ];
        });

        $this->activePackages = $this->packages->where('is_active', true)->count();

        // Referrals with generation & commission
        $this->referrals = [];
        foreach ($this->user->referrals as $referral) {
            $gens = getUserGenerations($referral, null, 1); // 1 generation for direct referral
            $this->referrals[] = (object) [
                'name' => $referral->name,
                'email' => $referral->email,
                'generation' => $gens[0]['generation'] ?? 1,
                'commission_percent' => $gens[0]['commission_percent'] ?? 0,
            ];
        }

        $this->generations = getUserGenerations($this->user);

        // Withdraws
        $this->withdraws = $this->user->withdraws;
    }

    public function render()
    {
        return view('livewire.frontend.user.dashboard');
    }
}
