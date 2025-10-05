<?php

namespace App\Livewire\Backend\ReferralGeneration;

use Livewire\Component;
use App\Models\ReferralGeneration;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $generation;
    public $commission_percent;
    public $refGenId;

    public $search = '';
    public $sortField = 'generation';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $confirmingDelete = false;
    public $deleteId;

    protected $rules = [
        'generation' => 'required|integer|min:1',
        'commission_percent' => 'required|numeric|min:0|max:100',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        ReferralGeneration::updateOrCreate(
            ['id' => $this->refGenId],
            [
                'generation' => $this->generation,
                'commission_percent' => $this->commission_percent,
            ]
        );

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Referral generation saved successfully!']);
    }

    public function edit($id)
    {
        $refGen = ReferralGeneration::findOrFail($id);
        $this->refGenId = $refGen->id;
        $this->generation = $refGen->generation;
        $this->commission_percent = $refGen->commission_percent;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        ReferralGeneration::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Referral generation deleted successfully!']);
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
        $this->reset(['refGenId', 'generation', 'commission_percent']);
    }

    public function render()
    {
        $refGens = ReferralGeneration::where('generation', 'like', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.referral-generation.index', compact('refGens'));
    }
}
