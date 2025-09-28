<?php

namespace App\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        // Redirect to home after logout
        return redirect()->route('home.index');
    }
    
    public function render()
    {
        return view('livewire.frontend.auth.logout');
    }
}
