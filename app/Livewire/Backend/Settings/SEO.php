<?php

namespace App\Livewire\Backend\Settings;

use Livewire\Component;
use App\Models\Setting;

class SEO extends Component
{
    public $meta_title, $meta_keywords, $meta_description;

    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->fill($setting->only(['meta_title', 'meta_keywords', 'meta_description']));
        }
    }

    protected function rules()
    {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $setting = Setting::first() ?? new Setting();
        $setting->updateOrCreate(['id' => $setting->id ?? 0], $validated);

        $this->dispatch('notify', ['type' => 'success', 'message' => 'SEO settings updated!']);
    }

    public function render()
    {
        return view('livewire.backend.settings.s-e-o');
    }
}
