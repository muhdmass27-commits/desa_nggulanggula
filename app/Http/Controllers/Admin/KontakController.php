<?php
// FILE BARU: app/Http/Controllers/Admin/KontakController.php
// Kontak adalah data TUNGGAL (1 baris, id=1).

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KontakRequest;
use App\Models\Kontak;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KontakController extends Controller
{
    public function edit(): View
    {
        $kontak = Kontak::firstOrNew(['id' => 1]);

        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(KontakRequest $request): RedirectResponse
    {
        Kontak::updateOrCreate(['id' => 1], $request->validated());

        return redirect()->route('admin.kontak.edit')
            ->with('status', 'Informasi kontak berhasil diperbarui.');
    }
}
