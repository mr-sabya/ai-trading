<?php

namespace App\Livewire\Backend\Settings;

use Livewire\Component;
use App\Models\Setting;

class Additional extends Component
{
    public $google_analytics, $facebook_pixel, $timezone, $currency, $maintenance_mode;

    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->fill($setting->only([
                'google_analytics',
                'facebook_pixel',
                'timezone',
                'currency',
                'maintenance_mode'
            ]));
        }
    }

    protected function rules()
    {
        return [
            'google_analytics' => 'nullable|string',
            'facebook_pixel' => 'nullable|string',
            'timezone' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:10',
            'maintenance_mode' => 'boolean',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $setting = Setting::first() ?? new Setting();
        $setting->updateOrCreate(['id' => $setting->id ?? 0], $validated);

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Additional settings updated!']);
    }

    public function render()
    {
        return view('livewire.backend.settings.additional');
    }
}
