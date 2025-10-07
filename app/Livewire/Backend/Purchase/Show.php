<?php

namespace App\Livewire\Backend\Purchase;

use App\Models\Purchase;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $purchaseId;
    public $purchase;

    // Confirmation modals
    public $confirmingApprove = false;
    public $confirmingCancel = false;

    protected $listeners = ['refreshPurchaseShow' => '$refresh'];

    public function mount($id)
    {
        $this->purchaseId = $id;
        $this->loadPurchase();
    }

    public function loadPurchase()
    {
        $this->purchase = Purchase::with([
            'user',
            'package',
            'histories' => fn($q) => $q->latest(),
            'referralCommissions' => fn($q) => $q->latest()->with('user'),
        ])->findOrFail($this->purchaseId);
    }

    // --- Actions ---

    public function confirmApprove()
    {
        $this->confirmingApprove = true;
    }

    public function confirmCancel()
    {
        $this->confirmingCancel = true;
    }

    public function approvePurchase()
    {
        $purchase = $this->purchase;

        if ($purchase->status === 'pending') {
            $purchase->status = 'approved';
            if (is_null($purchase->expires_at) || $purchase->expires_at->isPast()) {
                $period = $purchase->package->billing_cycle === 'monthly' ? 1 : 12;
                $purchase->expires_at = now()->addMonths($period);
            }
            $purchase->save();

            $purchase->recordHistory('approved', $purchase->first_price);
            $purchase->generateReferralCommissions();

            $this->dispatch('notify', ['type' => 'success', 'message' => 'Purchase approved successfully.']);
        } else {
            $this->dispatch('notify', ['type' => 'info', 'message' => 'Purchase cannot be approved.']);
        }

        $this->confirmingApprove = false;
        $this->loadPurchase();
    }

    public function cancelPurchase()
    {
        $purchase = $this->purchase;

        if ($purchase->status !== 'cancelled') {
            $purchase->status = 'cancelled';
            $purchase->expires_at = Carbon::now();
            $purchase->save();
            $purchase->recordHistory('cancelled', 0);

            $this->dispatch('notify', ['type' => 'success', 'message' => 'Purchase cancelled successfully.']);
        } else {
            $this->dispatch('notify', ['type' => 'info', 'message' => 'Purchase is already cancelled.']);
        }

        $this->confirmingCancel = false;
        $this->loadPurchase();
    }

    public function render()
    {
        return view('livewire.backend.purchase.show');
    }
}
