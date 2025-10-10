<?php

namespace App\Livewire\Backend\Testimonial;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $testimonialId;
    public $name, $designation, $message;

    // File uploads
    public $image;
    public $current_image;

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
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|max:1024', // 1MB
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
            'name' => $this->name,
            'designation' => $this->designation,
            'message' => $this->message,
        ];

        $testimonial = $this->testimonialId ? Testimonial::find($this->testimonialId) : null;

        if ($this->image) {
            // Delete the old image if it exists
            if ($testimonial && $testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $this->image->store('testimonials', 'public');
        }

        Testimonial::updateOrCreate(['id' => $this->testimonialId], $data);

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Testimonial saved successfully!']);
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->testimonialId = $testimonial->id;
        $this->name = $testimonial->name;
        $this->designation = $testimonial->designation;
        $this->message = $testimonial->message;
        $this->current_image = $testimonial->image;
        $this->image = null; // Clear the file input
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $testimonial = Testimonial::findOrFail($this->deleteId);
        // Delete the image from storage
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();

        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Testimonial deleted successfully!']);
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
    }

    public function render()
    {
        $testimonials = Testimonial::where('name', 'like', "%{$this->search}%")
            ->orWhere('designation', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.testimonial.index', ['testimonials' => $testimonials]);
    }
}
