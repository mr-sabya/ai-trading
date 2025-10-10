<?php

namespace App\Livewire\Backend\Partner;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $partnerId;
    public $name;
    public $link;
    public $logo;
    public $current_logo;

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
            'link' => 'nullable|string|max:255',
            // Logo is required for new partners, but optional when updating
            'logo' => $this->partnerId ? 'nullable|image|max:1024' : 'required|image|max:1024',
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
            'link' => $this->link,
        ];

        if ($this->logo) {
            // Delete the old logo if it exists
            if ($this->partnerId) {
                $oldPartner = Partner::find($this->partnerId);
                if ($oldPartner && $oldPartner->logo) {
                    Storage::disk('public')->delete($oldPartner->logo);
                }
            }
            $data['logo'] = $this->logo->store('partners', 'public');
        }

        Partner::updateOrCreate(['id' => $this->partnerId], $data);

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Partner saved successfully!']);
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        $this->partnerId = $partner->id;
        $this->name = $partner->name;
        $this->link = $partner->link;
        $this->current_logo = $partner->logo;
        $this->logo = null; // Clear previous file input
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        $partner = Partner::findOrFail($this->deleteId);
        // Delete the logo file from storage
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();

        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Partner deleted successfully!']);
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
        $this->reset(['partnerId', 'name', 'link', 'logo', 'current_logo']);
    }

    public function render()
    {
        $partners = Partner::where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.partner.index', compact('partners'));
    }
}
