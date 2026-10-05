<?php
// FILE BARU: app/Http/Controllers/Admin/Auth/AdminLoginController.php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Proses login admin.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $user = Auth::user();

        if ($user->role !== 'admin' || $user->status !== 'aktif') {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses admin atau sudah dinonaktifkan.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Logout admin.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Anda telah logout.');
    }
}
