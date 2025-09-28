<?php

namespace App\Livewire\Backend\Package;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Feature;
use App\Models\Package;

class FeatureManage extends Component
{
    use WithPagination;

    public $package;
    public $featureId;
    public $feature_name;
    public $feature_value;
    public $is_limited = false;

    public $confirmingDelete = false;
    public $deleteId;

    protected $rules = [
        'feature_name' => 'required|string|max:255',
        'feature_value' => 'nullable|string|max:255',
        'is_limited' => 'boolean',
    ];

    public function mount(Package $package)
    {
        $this->package = $package;
    }

    public function save()
    {
        $this->validate();

        Feature::updateOrCreate(
            ['id' => $this->featureId],
            [
                'package_id' => $this->package->id,
                'feature_name' => $this->feature_name,
                'feature_value' => $this->feature_value,
                'is_limited' => $this->is_limited,
            ]
        );

        $this->resetForm();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Feature saved successfully!']);
    }

    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        $this->featureId = $feature->id;
        $this->feature_name = $feature->feature_name;
        $this->feature_value = $feature->feature_value;
        $this->is_limited = $feature->is_limited;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        Feature::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Feature deleted successfully!']);
    }

    public function resetForm()
    {
        $this->reset(['featureId', 'feature_name', 'feature_value', 'is_limited']);
        $this->is_limited = false;
    }

    public function render()
    {
        $features = Feature::where('package_id', $this->package->id)->paginate(10);

        return view('livewire.backend.package.feature-manage', compact('features'));
    }
}
