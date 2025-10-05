<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $confirmingDelete = false;
    public $deleteId;

    protected $listeners = ['userUpdated' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        User::where('is_admin', false)->findOrFail($this->deleteId)->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'User deleted successfully.']);
        $this->confirmingDelete = false;
    }

    public function render()
    {
        $users = User::where('is_admin', false)
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.backend.user.index', [
            'users' => $users,
        ]);
    }
}
