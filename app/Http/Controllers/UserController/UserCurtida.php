<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCurtida extends Controller
{
    public function __invoke()
    {
        $curtidas = auth()->user()->curtidas;

        return response(['curtidas' => $curtidas], 200);
    }
}
