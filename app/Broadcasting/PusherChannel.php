<?php

namespace App\Broadcasting;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Pusher\Pusher;

class PusherChannel
{
    public function __construct()
    {
    }

    public function join(User $user)
    {

    }

    public function send($notifiable, Notification $notification): void
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

        $data['message'] = $notification->toBroadcast($notifiable);

        $pusher->trigger(
            'notification-channel',
            'refresh-notifications',
            $data
        );
    }
}
