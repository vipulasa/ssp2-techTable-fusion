<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdministratorCreatedNotification extends Notification
{
    public function __construct(
        public User $user
    )
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Administrator Created')
            ->greeting('Hello '.($notifiable->name ? $notifiable->name : 'User').',')
            ->line('A new administrator has been created.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
