<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class WelcomeSystemNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'icon' => 'info',
            'message' => 'Welcome to the application!',
            'action' => url('/'),
        ];
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
