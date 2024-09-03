<?php

namespace App\Notifications;

use App\Broadcasting\PusherChannel;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Pusher\Pusher;

class WelcomeBroadcastNotification extends Notification
{

    public $message;

    public function __construct()
    {
        $this->message = 'Welcome to the application!';
    }

    public function via($notifiable): array
    {
        return [
            'database',
            PusherChannel::class,
        ];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'icon' => 'info',
            'message' => 'Welcome to the application!',
            'action' => url('/'),
        ];
    }

    public function toBroadcast($notifiable): array
    {
        return [
            'message' => 'ela kiri'
        ];
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
