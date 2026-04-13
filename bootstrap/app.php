<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectTo(
            guests: '/login', // Kalau belum login, lempar ke sini
            users: '/dashboard/user' // Kalau SUDAH login tapi akses login/register lagi, lempar ke sini
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
