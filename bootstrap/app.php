<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Logic untuk yang BELUM login (Guest)
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin*')) {
                return route('signin');
            }
            return route('home');
        });

        // 2. Logic untuk yang SUDAH login (Authenticated)
        // INI YANG KURANG: Menentukan arah setelah login sukses
        $middleware->redirectUsersTo(function ($request) {
            // Jika login menggunakan guard admin, lempar ke landing admin
            if (Auth::guard('admin')->check()) {
                return route('admins.landing');
            }

            // Jika login sebagai peserta biasa
            return route('peserta.beranda');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
