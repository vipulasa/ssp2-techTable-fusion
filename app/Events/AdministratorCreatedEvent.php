<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class AdministratorCreatedEvent
{
    use Dispatchable;

    public function __construct(
        public User $user
    )
    {
    }
}
