<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Package;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class Index extends Component
{
    public $packageId;
    public $package;
    public $price;
    public $billing_cycle;
    public $confirming = false;
    public $binanceOrderId; // user input

    protected $rules = [
        'binanceOrderId' => 'required|string|max:255',
    ];

    protected $listeners = ['checkoutPackage' => 'loadPackage'];
    

    public function mount($packageId = null)
    {
        if ($packageId) {
            $this->loadPackage($packageId);
        }
    }

    public function loadPackage($id)
    {
        $this->package = Package::with('features')->findOrFail($id);
        $this->packageId = $id;
        $this->price = $this->package->first_price;
        $this->billing_cycle = $this->package->billing_cycle;
    }

    public function confirmCheckout()
    {
        $this->validate(); // validate Binance Order ID

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->confirming = true;
    }

    public function completeCheckout()
    {
        $user = Auth::user();

        $period = $this->package->billing_cycle === 'monthly' ? 1 : 12;
        $expiresAt = Carbon::now()->addMonths($period);

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'package_id' => $this->package->id,
            'first_price' => $this->package->first_price,
            'renew_price' => $this->package->renew_price,
            'status' => 'completed',
            'expires_at' => $expiresAt,
            'binance_order_id' => $this->binanceOrderId, // user input
        ]);

        $purchase->recordHistory('initial', $this->package->first_price);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => "Checkout successful! Binance Order ID: {$this->binanceOrderId}"
        ]);

        $this->reset(['confirming', 'binanceOrderId']);
    }


    public function render()
    {
        return view('livewire.frontend.checkout.index');
    }
}
