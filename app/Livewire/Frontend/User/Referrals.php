<?php

namespace App\Livewire\Frontend\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Referrals extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    public $generations = [];

    public function mount()
    {
        $user = User::find(Auth::id());
        $this->generations = getUserGenerations($user);
    }

    public function render()
    {
        $user = User::find(Auth::id());

        $referrals = $user->referrals()
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                }
            })
            ->with(['referrer'])
            ->paginate($this->perPage);

        return view('livewire.frontend.user.referrals', compact('referrals'));
    }
}
