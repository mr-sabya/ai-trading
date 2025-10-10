<?php

namespace App\Livewire\Backend\TeamMember;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $teamMemberId;
    public $name, $slug, $designation, $facebook, $twitter, $linkedin, $order = 0;

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
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            // Ignore the current member ID when checking for a unique slug
            'slug' => 'required|string|max:255|unique:team_members,slug,' . $this->teamMemberId,
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'order' => 'required|integer',
            'image' => 'nullable|image|max:1024', // 1MB
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    // Automatically generate slug from name
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'designation' => $this->designation,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'order' => $this->order,
        ];

        $member = $this->teamMemberId ? TeamMember::find($this->teamMemberId) : null;

        if ($this->image) {
            // Delete the old image if it exists
            if ($member && $member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $data['image'] = $this->image->store('team', 'public');
        }

        TeamMember::updateOrCreate(['id' => $this->teamMemberId], $data);

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Team member saved successfully!']);
    }

    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);
        $this->teamMemberId = $member->id;
        $this->name = $member->name;
        $this->slug = $member->slug;
        $this->designation = $member->designation;
        $this->facebook = $member->facebook;
        $this->twitter = $member->twitter;
        $this->linkedin = $member->linkedin;
        $this->order = $member->order;
        $this->current_image = $member->image;
        $this->image = null; // Clear the file input
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $member = TeamMember::findOrFail($this->deleteId);
        // Delete the image from storage
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();

        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Team member deleted successfully!']);
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
        $teamMembers = TeamMember::where('name', 'like', "%{$this->search}%")
            ->orWhere('designation', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.team-member.index', ['teamMembers' => $teamMembers]);
    }
}
