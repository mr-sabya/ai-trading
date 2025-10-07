<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Package;
use App\Models\Purchase;
use App\Models\User; // Import the User model
use App\Notifications\NewPurchaseNotification; // Import the Notification class
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

        // 1. Create the Purchase record
        $purchase = Purchase::create([ // Store the created purchase in a variable
            'user_id' => $user->id,
            'package_id' => $this->package->id,
            'first_price' => $this->package->first_price,
            'renew_price' => $this->package->renew_price,
            'status' => 'pending',
            'expires_at' => $expiresAt,
            'binance_order_id' => $this->binanceOrderId, // user input
        ]);

        // 2. Find all admin users
        $adminUsers = User::where('is_admin', true)->get();

        // 3. Send the notification to each admin user
        foreach ($adminUsers as $admin) {
            $admin->notify(new NewPurchaseNotification($purchase));
        }

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
