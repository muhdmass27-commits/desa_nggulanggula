<?php
// FILE BARU: app/Http/Controllers/Admin/PasswordController.php
// Fitur ganti password admin sendiri (dijanjikan sejak Tahap 3, dikerjakan
// sekarang sebagai bagian audit keamanan Tahap 6).

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function edit(): View
    {
        return view('admin.pengaturan-akun.edit');
    }

    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return redirect()->route('admin.akun.edit')->with('status', 'Password berhasil diganti.');
    }
}
