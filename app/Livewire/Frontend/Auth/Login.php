<?php

namespace App\Livewire\Frontend\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            session()->flash('success', 'Login successful!');
            return redirect()->route('dashboard.index'); // change if your dashboard route differs
        }

        $this->addError('email', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
