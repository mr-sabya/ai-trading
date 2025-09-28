<?php

namespace App\Livewire\Frontend\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Profile extends Component
{
    use WithFileUploads;

    public \App\Models\User $user;

    public $first_name;
    public $last_name;
    public $email;
    public $image;
    public $current_image;
    public $new_password;
    public $new_password_confirmation;
    public $old_password;

    public $activeTab = 'info'; // tabs: info, password, image

    public function mount()
    {
        $this->user = Auth::user();
        [$this->first_name, $this->last_name] = explode(' ', $this->user->name . ' ');
        $this->email = $this->user->email;
        $this->current_image = $this->user->image;
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users','email')->ignore($this->user->id)],
            'image' => 'nullable|image|max:2048',
            'old_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateInfo()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users','email')->ignore($this->user->id)],
        ]);

        $this->user->name = $this->first_name . ' ' . $this->last_name;
        $this->user->email = $this->email;
        $this->user->save();

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Info updated successfully!']);
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($this->old_password, $this->user->password)) {
            $this->addError('old_password', 'Old password is incorrect.');
            return;
        }

        $this->user->password = Hash::make($this->new_password);
        $this->user->save();

        $this->new_password = $this->new_password_confirmation = $this->old_password = null;

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Password updated successfully!']);
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $this->image->store('profile', 'public');
        $this->user->image = $path;
        $this->user->save();
        $this->current_image = $path;
        $this->image = null;

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Profile image updated successfully!']);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.frontend.user.profile');
    }
}
