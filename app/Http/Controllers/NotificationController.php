<?php

namespace App\Http\Controllers;

use App\Models\User;

class NotificationController extends Controller
{
    public function index()
    {

        // get the first user
        $user = (new User())->first();

        // send the user a welcome notification
        // $user->notify(new \App\Notifications\WelcomeNotification());

        // send the user a welcome system notification
//        $user->notify(new \App\Notifications\WelcomeSystemNotification());

        $user->notify(new \App\Notifications\WelcomeBroadcastNotification());

//        dd($user->notifications);

        return view('notification');
    }
}
