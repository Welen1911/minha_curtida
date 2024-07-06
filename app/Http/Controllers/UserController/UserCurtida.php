<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCurtida extends Controller
{
    public function __invoke()
    {
        return auth()->user();
    }
}
