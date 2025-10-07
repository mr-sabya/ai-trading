<?php

namespace App\Livewire\Backend\Purchase;

use App\Models\Purchase; // Import the Purchase model
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id'; // Default sort by ID
    public $sortDirection = 'desc'; // Show latest first

    // Properties for confirmation modals
    public $confirmingApprove = false;
    public $confirmingCancel = false;
    public $confirmingDelete = false;
    public $purchaseIdToActOn; // Holds the ID of the purchase being acted upon

    protected $listeners = ['purchaseUpdated' => '$refresh']; // Listen for updates to refresh the list

    // Reset pagination when search term changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Handle sorting when a column header is clicked
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // --- Action Confirmation Methods ---
    public function confirmApprove($id)
    {
        $this->confirmingApprove = true;
        $this->purchaseIdToActOn = $id;
    }

    public function confirmCancel($id)
    {
        $this->confirmingCancel = true;
        $this->purchaseIdToActOn = $id;
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->purchaseIdToActOn = $id;
    }

    // --- Action Methods ---

    public function approvePurchase()
    {
        $purchase = Purchase::findOrFail($this->purchaseIdToActOn);
        // Only approve if it's currently pending
        if ($purchase->status === 'pending') {
            $purchase->status = 'approved';
            // When approving, you might want to renew/activate the subscription
            // The renew method on your Purchase model does this.
            $purchase->renew(); // This also sets status to 'completed' and updates expires_at
            // If you want to keep 'approved' as a distinct status before 'completed' in renew,
            // you'd need to adjust your Purchase model's renew() method or this logic.
            // For now, let's assume 'renew' means activate and sets status to 'completed'.
            // If 'approved' is meant to be a transient state, remove $purchase->renew()
            // and simply set $purchase->status = 'approved'; $purchase->save();
            // and handle activation separately.

            // Let's stick to your enum: pending, approved, cancelled.
            // So if 'approved' means "it's good to go, now activate it for the user",
            // then we should set status to 'approved' and call renew if that's your activation logic.
            // Or, if 'approved' is the final state for an active purchase, just set status.

            // For clarity based on your enum:
            $purchase->status = 'approved';
            $purchase->save();

            // If a purchase needs its expiry date updated upon approval, do it here
            // based on the 'approved' status meaning it's now active.
            // The `renew()` method on the Purchase model is good for this, but it sets status to 'completed'.
            // Let's explicitly handle it here for 'approved' status:
            if (is_null($purchase->expires_at) || $purchase->expires_at->isPast()) {
                $period = $purchase->package->billing_cycle === 'monthly' ? 1 : 12;
                $purchase->expires_at = now()->addMonths($period);
                $purchase->save();
            }

            $purchase->recordHistory('approved', $purchase->first_price); // Assuming first_price on approval

            $this->dispatch('notify', ['type' => 'success', 'message' => 'Purchase approved successfully.']);
        } else {
            $this->dispatch('notify', ['type' => 'info', 'message' => 'Purchase is not in pending status to be approved.']);
        }
        $this->resetConfirmationModals();
    }

    public function cancelPurchase()
    {
        $purchase = Purchase::findOrFail($this->purchaseIdToActOn);
        // Only cancel if not already cancelled
        if ($purchase->status !== 'cancelled') {
            $purchase->status = 'cancelled';
            $purchase->expires_at = Carbon::now(); // Optionally set expiry to now for cancelled purchases
            $purchase->save();
            $purchase->recordHistory('cancelled', 0); // Amount 0 for cancellation

            $this->dispatch('notify', ['type' => 'success', 'message' => 'Purchase cancelled successfully.']);
        } else {
            $this->dispatch('notify', ['type' => 'info', 'message' => 'Purchase is already cancelled.']);
        }
        $this->resetConfirmationModals();
    }

    public function deletePurchase()
    {
        $purchase = Purchase::findOrFail($this->purchaseIdToActOn);
        $purchase->delete(); // This will also delete related histories due to cascading if set up

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Purchase deleted successfully.']);
        $this->resetConfirmationModals();
    }

    // Helper to reset all confirmation states
    private function resetConfirmationModals()
    {
        $this->confirmingApprove = false;
        $this->confirmingCancel = false;
        $this->confirmingDelete = false;
        $this->purchaseIdToActOn = null;
    }

    // Render method to fetch data and pass to view
    public function render()
    {
        $purchases = Purchase::with(['user', 'package']) // Eager load relationships
            ->where(function ($q) {
                // Search by purchase ID, user name, user email, or package name
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('package', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.purchase.index', [
            'purchases' => $purchases,
        ]);
    }
}
