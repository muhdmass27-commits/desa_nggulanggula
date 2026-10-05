<?php
// FILE BARU: app/Http/Middleware/EnsureUserIsAdmin.php
// Memastikan user yang login benar-benar role=admin dan status=aktif.
// Didaftarkan sebagai alias 'admin' di bootstrap/app.php.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'admin' || $user->status !== 'aktif') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Akun tidak memiliki akses admin atau sudah dinonaktifkan.',
            ]);
        }

        return $next($request);
    }
}
