<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationComponent extends Component
{
    public function getNotificationsProperty()
    {
        return auth()->user()->unreadNotifications()->get();
    }

    public function render()
    {
        return view('livewire.notification-component', [
            'notifications' => $this->notifications
        ]);
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
    }
}
