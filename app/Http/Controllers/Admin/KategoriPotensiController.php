<?php
// FILE BARU: app/Http/Controllers/Admin/KategoriPotensiController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriPotensiRequest;
use App\Models\KategoriPotensi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KategoriPotensiController extends Controller
{
    public function index(): View
    {
        $kategoriPotensi = KategoriPotensi::withCount('potensi')->orderBy('nama')->paginate(15);
        return view('admin.informasi-desa.kategori-potensi.index', compact('kategoriPotensi'));
    }

    public function create(): View
    {
        return view('admin.informasi-desa.kategori-potensi.create');
    }

    public function store(KategoriPotensiRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['nama']);
        KategoriPotensi::create($data);
        return redirect()->route('admin.informasi-desa.kategori-potensi.index')->with('status', 'Kategori berhasil disimpan.');
    }

    public function edit(KategoriPotensi $kategori_potensi): View
    {
        return view('admin.informasi-desa.kategori-potensi.edit', ['kategoriPotensi' => $kategori_potensi]);
    }

    public function update(KategoriPotensiRequest $request, KategoriPotensi $kategori_potensi): RedirectResponse
    {
        $data = $request->validated();
        if ($data['nama'] !== $kategori_potensi->nama) {
            $data['slug'] = $this->uniqueSlug($data['nama'], $kategori_potensi->id);
        }
        $kategori_potensi->update($data);
        return redirect()->route('admin.informasi-desa.kategori-potensi.index')->with('status', 'Perubahan berhasil disimpan.');
    }

    public function destroy(KategoriPotensi $kategori_potensi): RedirectResponse
    {
        if ($kategori_potensi->potensi()->exists()) {
            return redirect()->route('admin.informasi-desa.kategori-potensi.index')
                ->withErrors(['nama' => 'Kategori tidak dapat dihapus karena masih dipakai oleh data potensi desa.']);
        }
        $kategori_potensi->delete();
        return redirect()->route('admin.informasi-desa.kategori-potensi.index')->with('status', 'Kategori berhasil dihapus.');
    }

    private function uniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $base = Str::slug($nama) ?: 'kategori';
        $slug = $base; $i = 2;
        while (KategoriPotensi::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}"; $i++;
        }
        return $slug;
    }
}
