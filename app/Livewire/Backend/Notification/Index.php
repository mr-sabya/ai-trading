<?php

namespace App\Livewire\Backend\Notification;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $perPage = 10;
    public $search = '';
    public $filter = 'all'; // all, read, unread

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['notificationUpdated' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
        }

        $this->dispatch('notify', type: 'success', message: 'Notification marked as read.');
    }

    public function markAsUnread($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if ($notification && $notification->read_at) {
            $notification->update(['read_at' => null]);
        }

        $this->dispatch('notify', type: 'success', message: 'Notification marked as unread.');
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->dispatch('notify', type: 'success', message: 'All notifications marked as read.');
    }

    public function render()
    {
        $user = Auth::user();

        $query = $user->notifications();

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'read') {
            $query->whereNotNull('read_at');
        }

        if ($this->search) {
            $query->where('data->message', 'like', '%' . $this->search . '%');
        }

        $notifications = $query->latest()->paginate($this->perPage);

        return view('livewire.backend.notification.index', compact('notifications'));
    }
}
