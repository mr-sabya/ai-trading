<?php

namespace App\Livewire\Backend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{

    /**
     * Log the user out of the application.
     */
    public function logout()
    {
        // Use Laravel's built-in authentication system to log the user out.
        Auth::logout();

        // Invalidate the user's session, preventing misuse of the old session.
        request()->session()->invalidate();

        // Regenerate the CSRF token for the new session.
        request()->session()->regenerateToken();

        // Redirect the user to the admin login page after logout.
        return redirect()->route('admin.login');
    }
    public function render()
    {
        return view('livewire.backend.auth.logout');
    }
}
