<?php
// FILE BARU: app/Http/Controllers/Admin/ProfilDesaController.php
// Profil Desa adalah data TUNGGAL (1 baris, id=1) - hanya edit & update,
// tidak ada create/delete karena datanya sudah disiapkan seeder Tahap 2.

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilDesaRequest;
use App\Models\ProfilDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilDesaController extends Controller
{
    public function edit(): View
    {
        $profil = ProfilDesa::firstOrNew(['id' => 1]);

        return view('admin.profil-desa.edit', compact('profil'));
    }

    public function update(ProfilDesaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $existing = ProfilDesa::find(1);

        if ($request->hasFile('logo')) {
            if ($existing?->logo) {
                Storage::disk('public')->delete($existing->logo);
            }
            $data['logo'] = $request->file('logo')->store('profil', 'public');
        }

        if ($request->hasFile('foto_kantor')) {
            if ($existing?->foto_kantor) {
                Storage::disk('public')->delete($existing->foto_kantor);
            }
            $data['foto_kantor'] = $request->file('foto_kantor')->store('profil', 'public');
        }

        ProfilDesa::updateOrCreate(['id' => 1], $data);

        return redirect()->route('admin.profil-desa.edit')
            ->with('status', 'Profil desa berhasil diperbarui dan langsung tampil di halaman publik.');
    }
}
