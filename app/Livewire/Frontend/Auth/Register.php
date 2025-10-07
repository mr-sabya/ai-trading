<?php

namespace App\Livewire\Frontend\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $refer_code;

    public function mount()
    {
        // Pre-fill refer_code from URL query if available
        $this->refer_code = request()->query('refer') ?? null;
    }

    // Use rules() method instead of $rules property
    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'refer_code' => 'nullable|string|exists:users,refer_code',
        ];
    }

    public function register()
    {
        $this->validate();

        // Find referring user if refer_code exists
        $referrerId = null;
        if ($this->refer_code) {
            $referrer = User::where('refer_code', $this->refer_code)->first();
            if ($referrer) {
                $referrerId = $referrer->id;
            }
        }

        // Generate a more complex unique refer code
        do {
            $newReferCode = strtoupper(Str::random(3) . mt_rand(100, 999) . substr(sha1(time()), 0, 4));
        } while (User::where('refer_code', $newReferCode)->exists());

        $user = User::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'refer_code' => $newReferCode,
            'refer_id' => $referrerId,
        ]);

        Auth::login($user);

        session()->flash('success', 'Account created successfully!');

        return $this->redirect(route('dashboard.index'), navigate:true);
    }

    public function render()
    {
        return view('livewire.frontend.auth.register');
    }
}
