<?php
// GANTI SELURUH ISI FILE bootstrap/app.php dengan ini.
// Perubahan dari default: menambahkan alias middleware 'admin' dan
// mengarahkan tamu yang belum login ke /admin/login.

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);

        // Jika tamu (belum login) membuka halaman yang butuh 'auth',
        // arahkan ke /admin/login (bukan /login default Laravel).
        $middleware->redirectGuestsTo('/admin/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
