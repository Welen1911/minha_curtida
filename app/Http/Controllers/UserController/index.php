<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;

class index extends Controller
{
    public function __invoke()
    {
        $users = User::where('id', '<>', auth()->user()->id)->get();

        return $users;
    }
}
