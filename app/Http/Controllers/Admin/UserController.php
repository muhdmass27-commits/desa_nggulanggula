<?php
// FILE BARU: app/Http/Controllers/Admin/UserController.php
// Manajemen akun Admin (menu "Pengguna" yang diminta sejak spesifikasi awal).
//
// Proteksi penting di sini (supaya tidak ada yang terkunci dari sistemnya sendiri):
// 1. Admin tidak bisa mengubah status/menghapus akun MILIK SENDIRI dari halaman ini
//    (pakai menu "Ganti Password" di Tahap 6 untuk urusan akun sendiri).
// 2. Admin aktif TERAKHIR tidak bisa dinonaktifkan atau dihapus oleh siapa pun -
//    mencegah seluruh sistem kehilangan akses admin sama sekali.

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $pengguna = User::orderBy('name')->paginate(10);

        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create(): View
    {
        return view('admin.pengguna.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'admin';

        User::create($data);

        return redirect()->route('admin.pengguna.index')->with('status', 'Akun admin baru berhasil dibuat.');
    }

    public function edit(User $pengguna): View
    {
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function update(UpdateUserRequest $request, User $pengguna): RedirectResponse
    {
        $data = $request->validated();
        $diriSendiri = $pengguna->id === $request->user()->id;

        // Mencegah admin menonaktifkan akun miliknya sendiri lewat halaman ini.
        if ($diriSendiri && $data['status'] !== 'aktif') {
            return back()->withInput()->withErrors([
                'status' => 'Anda tidak dapat menonaktifkan akun Anda sendiri dari sini.',
            ]);
        }

        // Mencegah admin aktif terakhir dinonaktifkan oleh siapa pun.
        if ($data['status'] !== 'aktif' && $this->jumlahAdminAktifLain($pengguna) === 0) {
            return back()->withInput()->withErrors([
                'status' => 'Tidak dapat menonaktifkan akun ini karena ini satu-satunya admin aktif yang tersisa.',
            ]);
        }

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $pengguna->update($data);

        return redirect()->route('admin.pengguna.index')->with('status', 'Data akun berhasil diperbarui.');
    }

    public function destroy(User $pengguna): RedirectResponse
    {
        if ($pengguna->id === auth()->id()) {
            return redirect()->route('admin.pengguna.index')
                ->withErrors(['name' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
        }

        if ($pengguna->status === 'aktif' && $this->jumlahAdminAktifLain($pengguna) === 0) {
            return redirect()->route('admin.pengguna.index')
                ->withErrors(['name' => 'Tidak dapat menghapus akun ini karena ini satu-satunya admin aktif yang tersisa.']);
        }

        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')->with('status', 'Akun berhasil dihapus.');
    }

    /**
     * Hitung berapa admin AKTIF selain $pengguna sendiri - dipakai untuk
     * memastikan selalu ada minimal 1 admin aktif tersisa di sistem.
     */
    private function jumlahAdminAktifLain(User $pengguna): int
    {
        return User::where('status', 'aktif')->where('id', '!=', $pengguna->id)->count();
    }
}
