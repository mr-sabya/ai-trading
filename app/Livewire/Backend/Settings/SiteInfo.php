<?php

namespace App\Livewire\Backend\Settings;

use Livewire\Component;
use App\Models\Setting;

class SiteInfo extends Component
{
    public $website_name, $tagline, $short_description, $copyright, $phone, $email, $address;

    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->fill($setting->only([
                'website_name',
                'tagline',
                'short_description',
                'copyright',
                'phone',
                'email',
                'address'
            ]));
        }
    }

    protected function rules()
    {
        return [
            'website_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'copyright' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $setting = Setting::first() ?? new Setting();
        $setting->updateOrCreate(['id' => $setting->id ?? 0], $validated);

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Site info updated!']);
    }

    public function render()
    {
        return view('livewire.backend.settings.site-info');
    }
}
