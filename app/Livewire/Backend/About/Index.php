<?php

namespace App\Livewire\Backend\About;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\About;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    // Model properties
    public $title;
    public $highlight;
    public $subtitle;
    public $description;
    public $button_text;
    public $button_link;
    public $exp_years_label;
    public $exp_years_value;
    public $customers_label;
    public $customers_value;

    // For file upload
    public $image;

    // For displaying the current image
    public $current_image;

    public function mount()
    {
        $about = About::first();
        if ($about) {
            $this->title = $about->title;
            $this->highlight = $about->highlight;
            $this->subtitle = $about->subtitle;
            $this->description = $about->description;
            $this->button_text = $about->button_text;
            $this->button_link = $about->button_link;
            $this->exp_years_label = $about->exp_years_label;
            $this->exp_years_value = $about->exp_years_value;
            $this->customers_label = $about->customers_label;
            $this->customers_value = $about->customers_value;
            $this->current_image = $about->image;
        }
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'exp_years_label' => 'nullable|string|max:255',
            'exp_years_value' => 'nullable|integer',
            'customers_label' => 'nullable|string|max:255',
            'customers_value' => 'nullable|string|max:255',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        // Find the first record or create a new one if none exists
        $about = About::firstOrCreate([]);

        $about->fill($this->only([
            'title',
            'highlight',
            'subtitle',
            'description',
            'button_text',
            'button_link',
            'exp_years_label',
            'exp_years_value',
            'customers_label',
            'customers_value'
        ]));

        if ($this->image) {
            // Delete the old image if it exists
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $about->image = $this->image->store('about', 'public');
        }

        $about->save();

        // Refresh the current image preview
        $this->current_image = $about->image;

        // Clear the file input
        $this->image = null;

        $this->dispatch('notify', ['type' => 'success', 'message' => 'About Us content updated successfully!']);
    }

    public function render()
    {
        return view('livewire.backend.about.index');
    }
}
