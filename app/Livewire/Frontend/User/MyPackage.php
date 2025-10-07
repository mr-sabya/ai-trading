<?php

namespace App\Livewire\Frontend\User;

use Livewire\Component;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MyPackage extends Component
{
    public $packages;
    public $userPurchases;

    public $selectedPackageId;

    public function mount()
    {
        $this->packages = Package::where('is_active', true)->get();
        $this->loadUserPurchases();
    }

    public function loadUserPurchases()
    {
        if (Auth::check()) {
            $this->userPurchases = Purchase::with('package')
                ->where('user_id', Auth::id())
                ->orderBy('expires_at', 'desc')
                ->get();
        } else {
            $this->userPurchases = collect();
        }
    }


    public function renew($purchaseId)
    {
        $purchase = Purchase::findOrFail($purchaseId);

        $purchase->expires_at = $purchase->expires_at && $purchase->expires_at->isFuture()
            ? $purchase->expires_at->addMonths($purchase->package->billing_cycle === 'monthly' ? 1 : 12)
            : now()->addMonths($purchase->package->billing_cycle === 'monthly' ? 1 : 12);

        $purchase->save();

        $purchase->recordHistory('renewal', $purchase->renew_price);

        $this->loadUserPurchases();

        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Package renewed successfully!']);
    }


    public function render()
    {
        return view('livewire.frontend.user.my-package');
    }
}
