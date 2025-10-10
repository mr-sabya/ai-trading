<?php

namespace App\Livewire\Backend\Service;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $serviceId;
    public $title, $slug, $description, $order = 0;

    // File uploads
    public $image;
    public $current_image;

    // Table properties
    public $search = '';
    public $sortField = 'order';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $confirmingDelete = false;
    public $deleteId;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            // Ignore the current service ID when checking for a unique slug
            'slug' => 'required|string|max:255|unique:services,slug,' . $this->serviceId,
            'description' => 'nullable|string',
            'order' => 'required|integer',
            'image' => 'nullable|image|max:2048', // 2MB
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    // Automatically generate slug from title
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'order' => $this->order,
        ];

        $service = $this->serviceId ? Service::find($this->serviceId) : null;

        if ($this->image) {
            // Delete the old image if it exists
            if ($service && $service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $this->image->store('services', 'public');
        }

        Service::updateOrCreate(['id' => $this->serviceId], $data);

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Service saved successfully!']);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $service->id;
        $this->title = $service->title;
        $this->slug = $service->slug;
        $this->description = $service->description;
        $this->order = $service->order;
        $this->current_image = $service->image;
        $this->image = null; // Clear the file input
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $service = Service::findOrFail($this->deleteId);
        // Delete the image from storage
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();

        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Service deleted successfully!']);
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
        $this->order = 0; // Default value
    }

    public function render()
    {
        $services = Service::where('title', 'like', "%{$this->search}%")
            ->orWhere('slug', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.service.index', ['services' => $services]);
    }
}
