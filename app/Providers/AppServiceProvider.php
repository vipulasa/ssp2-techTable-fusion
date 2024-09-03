<?php

namespace App\Providers;

use App\Events\AdministratorCreatedEvent;
use App\Listeners\AdminNotificationListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        // event binding
        Event::listen(
            AdministratorCreatedEvent::class,
            AdminNotificationListener::class
        );
    }
}
