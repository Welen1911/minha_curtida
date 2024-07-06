<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateCurtida extends Controller
{
    public function __invoke(string $id)
    {

        $user = User::find($id);

        $user->update([
            'curtidas' => $user->curtidas + 1,
        ]);

        return $user;
    }
}
