<?php

namespace App\Livewire\Backend\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class Logos extends Component
{
    use WithFileUploads;

    public $light_logo;
    public $dark_logo;
    public $favicon;

    public $current_light_logo;
    public $current_dark_logo;
    public $current_favicon;

    public function mount()
    {
        $settings = Setting::first();
        if ($settings) {
            $this->current_light_logo = $settings->light_logo;
            $this->current_dark_logo = $settings->dark_logo;
            $this->current_favicon = $settings->favicon;
        }
    }

    protected function rules()
    {
        return [
            'light_logo' => 'nullable|image|max:2048',
            'dark_logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $settings = Setting::first();

        if ($this->light_logo) {
            $settings->light_logo = $this->light_logo->store('settings', 'public');
        }
        if ($this->dark_logo) {
            $settings->dark_logo = $this->dark_logo->store('settings', 'public');
        }
        if ($this->favicon) {
            $settings->favicon = $this->favicon->store('settings', 'public');
        }

        $settings->save();

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Logos updated successfully!']);

        // Update current previews
        $this->current_light_logo = $settings->light_logo;
        $this->current_dark_logo = $settings->dark_logo;
        $this->current_favicon = $settings->favicon;
    }

    public function render()
    {
        return view('livewire.backend.settings.logos');
    }
}
