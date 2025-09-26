<?php

namespace App\Livewire\Backend\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = ''; // <-- ADD THIS LINE. This was the missing property.

    /** @var bool */
    public $remember = false;

    /**
     * Validation rules.
     */
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    /**
     * Handle the login attempt.
     */
    public function login()
    {
        // Now $this->validate() can find the public $password property and will work correctly.
        $credentials = $this->validate();
        $credentials['is_admin'] = 1;

        $credentials = $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_admin' => 1])) {
            request()->session()->regenerate();
            // dd(Auth::user());
            if (Auth::user()->is_admin ==1) {
                // dd(Auth::user());
                return $this->redirect(route('admin.dashboard'));
            }

            Auth::logout();
            $this->addError('email', 'You do not have permission to access this area.');
        } else {
            $this->addError('email', 'The provided credentials do not match our records.');
        }
    }

    public function render()
    {
        return view('livewire.backend.auth.login');
    }
}
