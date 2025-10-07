<?php

namespace App\Livewire\Frontend\User;

use App\Models\Withdraw as ModelsWithdraw;
use App\Models\User;
use App\Notifications\NewWithdrawRequestNotification;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Withdraw extends Component
{
    use WithPagination;

    public $amount;
    public $binance_id;
    public $notes;

    public $perPage = 10;

    protected $rules = [
        'amount' => 'required|numeric|min:1',
        'binance_id' => 'required|string|max:255',
        'notes' => 'nullable|string|max:500',
    ];

    public function submit()
    {
        $this->validate();

        $user = Auth::user();

        if ($this->amount > $user->balance) {
            $this->addError('amount', 'Insufficient balance.');
            return;
        }

        $withdraw = ModelsWithdraw::create([
            'user_id' => $user->id,
            'amount' => $this->amount,
            'binance_id' => $this->binance_id,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        // Notify admin(s)
        User::where('is_admin', 1)->get()->each(function ($admin) use ($withdraw) {
            $admin->notify(new NewWithdrawRequestNotification($withdraw));
        });

        $this->reset(['amount', 'binance_id', 'notes']);

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Withdraw request submitted.']);
    }

    public function render()
    {
        $user = User::find(Auth::id());
        $withdraws = $user->withdraws()->latest()->paginate($this->perPage);
        return view('livewire.frontend.user.withdraw', compact('withdraws'));
    }
}
