<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Manage extends Component
{
    public $userId;
    public $name, $email, $password, $refer, $referrer_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function mount($userId = null)
    {
        $this->userId = $userId;

        if ($this->userId) {
            $this->loadUserData();
        }
    }

    public function loadUserData()
    {
        $user = User::findOrFail($this->userId);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->referrer_id = $user->referrer_id;
        $this->refer = $user->referrer_id ? User::find($user->referrer_id)?->refer_code : null;
    }

    public function updated($field)
    {
        $this->validateOnly($field);

        if ($field === 'refer' && $this->refer) {
            $this->findReferUser();
        }
    }

    public function findReferUser()
    {
        $referUser = User::where('refer_code', $this->refer)->first();

        if ($referUser) {
            $this->referrer_id = $referUser->id;
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Referrer found: ' . $referUser->name]);
        } else {
            $this->referrer_id = null;
            $this->dispatch('notify', ['type' => 'error', 'message' => 'No user found with this referral code.']);
        }
    }

    public function save()
    {
        $data = $this->validate(
            $this->userId
                ? [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $this->userId,
                    'password' => 'nullable|min:6',
                ]
                : $this->rules
        );

        $user = $this->userId ? User::findOrFail($this->userId) : new User();

        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->referrer_id = $this->referrer_id;

        if (!$this->userId) {
            $user->refer_code = mt_rand(100000, 999999);
        }

        $user->is_admin = false;
        $user->save();

        $this->dispatch('notify', ['type' => 'success', 'message' => 'User saved successfully.']);
        $this->dispatch('userUpdated');

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'refer', 'referrer_id']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.backend.user.manage');
    }
}
