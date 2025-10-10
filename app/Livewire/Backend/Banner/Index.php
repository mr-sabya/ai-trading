<?php

namespace App\Livewire\Backend\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;

class Index extends Component
{
    use WithFileUploads;

    // Model properties
    public $heading;
    public $highlight;
    public $description;
    public $button_text;
    public $button_link;
    public $video_link;

    // For file uploads
    public $image;
    public $background_image;

    // For displaying current images
    public $current_image;
    public $current_background_image;

    public function mount()
    {
        $banner = Banner::first();
        if ($banner) {
            $this->heading = $banner->heading;
            $this->highlight = $banner->highlight;
            $this->description = $banner->description;
            $this->button_text = $banner->button_text;
            $this->button_link = $banner->button_link;
            $this->video_link = $banner->video_link;
            $this->current_image = $banner->image;
            $this->current_background_image = $banner->background_image;
        }
    }

    protected function rules()
    {
        return [
            'heading' => 'required|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url',
            'video_link' => 'nullable|url',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'background_image' => 'nullable|image|max:4096', // 4MB Max
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        // Find the first banner or create a new one if none exists
        $banner = Banner::firstOrCreate([]);

        $banner->heading = $this->heading;
        $banner->highlight = $this->highlight;
        $banner->description = $this->description;
        $banner->button_text = $this->button_text;
        $banner->button_link = $this->button_link;
        $banner->video_link = $this->video_link;

        if ($this->image) {
            $banner->image = $this->image->store('banners', 'public');
        }

        if ($this->background_image) {
            $banner->background_image = $this->background_image->store('banners', 'public');
        }

        $banner->save();

        // Refresh the current image previews
        $this->current_image = $banner->image;
        $this->current_background_image = $banner->background_image;

        // Clear the file input fields
        $this->image = null;
        $this->background_image = null;

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Banner updated successfully!']);
    }

    public function render()
    {
        return view('livewire.backend.banner.index');
    }
}
