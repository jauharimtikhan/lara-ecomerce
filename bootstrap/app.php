<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        // channels: __DIR__ . '/../routes/channels.php'

    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens([
            'midtrans/webhook'
        ]);

        $middleware->redirectGuestsTo(function ($request) {
            // Cek apakah pengguna belum login (guest)
            if (!Auth::check()) {
                // Redirect tamu (guest) ke halaman login sesuai dengan jalur yang diminta
                if (str_contains($request->getPathInfo(), '/admin/')) {
                    return '/admin/login';
                } else {
                    return '/membership/login';
                }
            }

            // Jika sudah login, tidak ada redirect, lanjutkan permintaan
            return null;
        });

        $middleware->redirectUsersTo(function ($request) {
            // Cek apakah pengguna sudah login (auth)
            if (Auth::check()) {
                // Redirect pengguna yang sudah login jika mencoba mengakses halaman login
                if (str_contains($request->getPathInfo(), '/admin/login')) {
                    return '/admin/home'; // Halaman setelah login admin
                } elseif (str_contains($request->getPathInfo(), '/membership/login')) {
                    return '/membership/home'; // Halaman setelah login membership
                }
            }

            // Jika pengguna tidak perlu di-redirect, lanjutkan permintaan
            return null;
        });

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
