<?php

namespace App\Livewire\Backend\Package;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Package;

class Index extends Component
{
    use WithPagination;

    public $packageId;
    public $name;
    public $description;
    public $billing_cycle = 'monthly';
    public $first_price;
    public $renew_price;
    public $is_active = true;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $confirmingDelete = false;
    public $deleteId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'billing_cycle' => 'required|in:monthly,yearly',
        'first_price' => 'required|numeric|min:0',
        'renew_price' => 'required|numeric|min:0',
        'is_active' => 'boolean',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        Package::updateOrCreate(
            ['id' => $this->packageId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'billing_cycle' => $this->billing_cycle,
                'first_price' => $this->first_price,
                'renew_price' => $this->renew_price,
                'is_active' => $this->is_active,
            ]
        );

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Package saved successfully!']);
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $this->packageId = $package->id;
        $this->name = $package->name;
        $this->description = $package->description;
        $this->billing_cycle = $package->billing_cycle;
        $this->first_price = $package->first_price;
        $this->renew_price = $package->renew_price;
        $this->is_active = $package->is_active;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        Package::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Package deleted successfully!']);
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
        $this->reset(['packageId', 'name', 'description', 'billing_cycle', 'first_price', 'renew_price', 'is_active']);
        $this->billing_cycle = 'monthly';
        $this->is_active = true;
    }

    public function render()
    {
        $packages = Package::where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.package.index', compact('packages'));
    }
}
