<?php

namespace App\Notifications;

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
            'broadcast',
            'database'
        ];
    }

    public function broadcastOn()
    {
        return ['notification-channel'];
    }

    public function broadcastAs()
    {
        return 'refresh-notifications';
    }

    public function toDatabase($notifiable): array
    {
        return [
            'icon' => 'info',
            'message' => 'Welcome to the application!',
            'action' => url('/'),
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            '50a2e6693f94dde830f7',
            '1b5e6784908dd0b06d52',
            '1859091',
            $options
        );

        $data['message'] = 'refresh';
        $pusher->trigger(
            'notification-channel',
            'refresh-notifications',
            $data
        );

        return new BroadcastMessage([

        ]);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
