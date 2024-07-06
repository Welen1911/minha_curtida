<?php

use App\Http\Controllers\UserController\CreateCurtida;
use App\Http\Controllers\UserController\index;
use App\Http\Controllers\UserController\UserCurtida;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('/user')->group(function () {
        Route::get('/', [index::class, '__invoke']);

        Route::get('/curtidas', [UserCurtida::class, '__invoke']);
        Route::put('/curtidas/{id}', [CreateCurtida::class, '__invoke']);
    });
});
