<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function updated(User $user): void
    {
        error_log($user->name. 'Curtido!');
    }
}
