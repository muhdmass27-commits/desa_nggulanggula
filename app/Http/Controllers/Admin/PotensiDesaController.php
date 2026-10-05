<?php
// FILE BARU: app/Http/Controllers/Admin/PotensiDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePotensiDesaRequest;
use App\Http\Requests\Admin\UpdatePotensiDesaRequest;
use App\Models\KategoriPotensi;
use App\Models\PotensiDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PotensiDesaController extends Controller
{
    public function index(): View
    {
        $potensiDesa = PotensiDesa::with('kategori')->latest()->paginate(10);
        return view('admin.informasi-desa.potensi-desa.index', compact('potensiDesa'));
    }

    public function create(): View
    {
        $kategori = KategoriPotensi::orderBy('nama')->get();
        return view('admin.informasi-desa.potensi-desa.create', compact('kategori'));
    }

    public function store(StorePotensiDesaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['nama']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('potensi-desa', 'public');
        }

        PotensiDesa::create($data);

        return redirect()->route('admin.informasi-desa.potensi-desa.index')
            ->with('status', 'Data potensi desa berhasil disimpan.');
    }

    public function edit(PotensiDesa $potensi_desa): View
    {
        $kategori = KategoriPotensi::orderBy('nama')->get();
        return view('admin.informasi-desa.potensi-desa.edit', ['potensiDesa' => $potensi_desa, 'kategori' => $kategori]);
    }

    public function update(UpdatePotensiDesaRequest $request, PotensiDesa $potensi_desa): RedirectResponse
    {
        $data = $request->validated();

        if ($data['nama'] !== $potensi_desa->nama) {
            $data['slug'] = $this->uniqueSlug($data['nama'], $potensi_desa->id);
        }

        if ($request->hasFile('foto')) {
            if ($potensi_desa->foto) {
                Storage::disk('public')->delete($potensi_desa->foto);
            }
            $data['foto'] = $request->file('foto')->store('potensi-desa', 'public');
        }

        $potensi_desa->update($data);

        return redirect()->route('admin.informasi-desa.potensi-desa.index')
            ->with('status', 'Perubahan potensi desa berhasil disimpan.');
    }

    public function destroy(PotensiDesa $potensi_desa): RedirectResponse
    {
        if ($potensi_desa->foto) {
            Storage::disk('public')->delete($potensi_desa->foto);
        }

        $potensi_desa->delete();

        return redirect()->route('admin.informasi-desa.potensi-desa.index')
            ->with('status', 'Data potensi desa berhasil dihapus.');
    }

    private function uniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $base = Str::slug($nama) ?: 'potensi';
        $slug = $base; $i = 2;
        while (PotensiDesa::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}"; $i++;
        }
        return $slug;
    }
}
