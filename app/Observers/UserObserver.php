<?php

namespace App\Observers;

use App\Events\CurtidaEvent;
use App\Models\User;

class UserObserver
{
    public function updated(User $user): void
    {
        CurtidaEvent::dispatch($user);
        error_log($user->name. 'Curtido!');
    }
}
