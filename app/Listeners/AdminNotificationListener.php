<?php

namespace App\Listeners;

use App\Events\AdministratorCreatedEvent;
use App\Models\User;
use App\Notifications\NewAdministratorCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminNotificationListener implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(AdministratorCreatedEvent $event): void
    {
        // get all the administrators
        $administrators = User::where('role', 1)->get();

        // send notification to all administrators
        foreach ($administrators as $administrator) {
            // $administrator->notify(new NewAdministratorCreatedNotification($event->user));
        }
    }
}
