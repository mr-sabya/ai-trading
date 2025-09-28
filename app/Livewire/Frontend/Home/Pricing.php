<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;
use App\Models\Package;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class Pricing extends Component
{
    public $purchases;

    public function mount()
    {
        if (Auth::check()) {
            // Get all purchases of the logged-in user
            $this->purchases = Purchase::with('package')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $this->purchases = collect();
        }
    }

    public function render()
    {
        $packages = Package::with('features')
            ->where('is_active', 1)
            ->get();

        return view('livewire.frontend.home.pricing', [
            'packages' => $packages,
        ]);
    }

    // Check if user has already purchased this package
    public function hasPurchased($packageId)
    {
        if (!Auth::check()) return false;

        return $this->purchases->contains(function ($purchase) use ($packageId) {
            return $purchase->package_id == $packageId && $purchase->isActive();
        });
    }
}
