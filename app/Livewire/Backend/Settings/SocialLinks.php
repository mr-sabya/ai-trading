<?php

namespace App\Livewire\Backend\Settings;

use Livewire\Component;
use App\Models\Setting;

class SocialLinks extends Component
{
    public $facebook, $instagram, $linkedin, $youtube, $twitter;

    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->fill($setting->only(['facebook', 'instagram', 'linkedin', 'youtube', 'twitter']));
        }
    }

    protected function rules()
    {
        return [
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $setting = Setting::first() ?? new Setting();
        $setting->updateOrCreate(['id' => $setting->id ?? 0], $validated);

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Social links updated!']);
    }

    public function render()
    {
        return view('livewire.backend.settings.social-links');
    }
}
