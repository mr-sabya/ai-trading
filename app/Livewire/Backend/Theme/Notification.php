<?php

namespace App\Livewire\Backend\Theme;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notification extends Component
{
    public $notifications;
    public $unreadCount = 0;

    protected $listeners = ['notificationUpdated' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $user = Auth::user();

        if ($user) {
            $this->notifications = $user->notifications()->latest()->take(10)->get();
            $this->unreadCount = $user->unreadNotifications()->count();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        $this->loadNotifications();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->loadNotifications();
    }

    
    public function render()
    {
        return view('livewire.backend.theme.notification');
    }
}
