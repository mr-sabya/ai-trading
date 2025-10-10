<?php

namespace App\Livewire\Backend\WebsiteFeature;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\WebsiteFeature;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $websiteFeatureId;
    public $title, $description, $tab_title, $floating_top_text, $floating_bottom_number, $floating_bottom_text;
    public $is_active = true;

    // File uploads
    public $main_image, $floating_top_image;
    public $current_main_image, $current_floating_top_image;

    // Table properties
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $confirmingDelete = false;
    public $deleteId;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tab_title' => 'required|string|max:255',
            'floating_top_text' => 'nullable|string|max:255',
            'floating_bottom_number' => 'nullable|string|max:255',
            'floating_bottom_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'main_image' => 'nullable|image|max:2048', // 2MB
            'floating_top_image' => 'nullable|image|max:1024', // 1MB
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'tab_title' => $this->tab_title,
            'floating_top_text' => $this->floating_top_text,
            'floating_bottom_number' => $this->floating_bottom_number,
            'floating_bottom_text' => $this->floating_bottom_text,
            'is_active' => $this->is_active,
        ];

        $feature = $this->websiteFeatureId ? WebsiteFeature::find($this->websiteFeatureId) : null;

        if ($this->main_image) {
            if ($feature && $feature->main_image) {
                Storage::disk('public')->delete($feature->main_image);
            }
            $data['main_image'] = $this->main_image->store('features', 'public');
        }

        if ($this->floating_top_image) {
            if ($feature && $feature->floating_top_image) {
                Storage::disk('public')->delete($feature->floating_top_image);
            }
            $data['floating_top_image'] = $this->floating_top_image->store('features', 'public');
        }

        WebsiteFeature::updateOrCreate(['id' => $this->websiteFeatureId], $data);

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Website Feature saved successfully!']);
    }

    public function edit($id)
    {
        $feature = WebsiteFeature::findOrFail($id);
        $this->websiteFeatureId = $feature->id;
        $this->title = $feature->title;
        $this->description = $feature->description;
        $this->tab_title = $feature->tab_title;
        $this->floating_top_text = $feature->floating_top_text;
        $this->floating_bottom_number = $feature->floating_bottom_number;
        $this->floating_bottom_text = $feature->floating_bottom_text;
        $this->is_active = $feature->is_active;

        $this->current_main_image = $feature->main_image;
        $this->current_floating_top_image = $feature->floating_top_image;
        $this->main_image = null;
        $this->floating_top_image = null;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $feature = WebsiteFeature::findOrFail($this->deleteId);
        if ($feature->main_image) {
            Storage::disk('public')->delete($feature->main_image);
        }
        if ($feature->floating_top_image) {
            Storage::disk('public')->delete($feature->floating_top_image);
        }
        $feature->delete();

        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Feature deleted successfully!']);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetForm()
    {
        $this->reset();
        $this->is_active = true; // Default value
    }

    public function render()
    {
        $features = WebsiteFeature::where('title', 'like', "%{$this->search}%")
            ->orWhere('tab_title', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.website-feature.index', ['features' => $features]);
    }
}
