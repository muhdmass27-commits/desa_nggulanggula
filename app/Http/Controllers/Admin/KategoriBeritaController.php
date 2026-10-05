<?php
// FILE BARU: app/Http/Controllers/Admin/KategoriBeritaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KategoriBeritaRequest;
use App\Models\KategoriBerita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KategoriBeritaController extends Controller
{
    public function index(): View
    {
        $kategoriBerita = KategoriBerita::withCount('berita')->orderBy('nama')->paginate(15);
        return view('admin.informasi-desa.kategori-berita.index', compact('kategoriBerita'));
    }

    public function create(): View
    {
        return view('admin.informasi-desa.kategori-berita.create');
    }

    public function store(KategoriBeritaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['nama']);
        KategoriBerita::create($data);
        return redirect()->route('admin.informasi-desa.kategori-berita.index')->with('status', 'Kategori berhasil disimpan.');
    }

    public function edit(KategoriBerita $kategori_berita): View
    {
        return view('admin.informasi-desa.kategori-berita.edit', ['kategoriBerita' => $kategori_berita]);
    }

    public function update(KategoriBeritaRequest $request, KategoriBerita $kategori_berita): RedirectResponse
    {
        $data = $request->validated();
        if ($data['nama'] !== $kategori_berita->nama) {
            $data['slug'] = $this->uniqueSlug($data['nama'], $kategori_berita->id);
        }
        $kategori_berita->update($data);
        return redirect()->route('admin.informasi-desa.kategori-berita.index')->with('status', 'Perubahan berhasil disimpan.');
    }

    public function destroy(KategoriBerita $kategori_berita): RedirectResponse
    {
        if ($kategori_berita->berita()->exists()) {
            return redirect()->route('admin.informasi-desa.kategori-berita.index')
                ->withErrors(['nama' => 'Kategori tidak dapat dihapus karena masih dipakai oleh berita. Ubah kategori berita tersebut terlebih dahulu.']);
        }
        $kategori_berita->delete();
        return redirect()->route('admin.informasi-desa.kategori-berita.index')->with('status', 'Kategori berhasil dihapus.');
    }

    private function uniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $base = Str::slug($nama) ?: 'kategori';
        $slug = $base; $i = 2;
        while (KategoriBerita::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}"; $i++;
        }
        return $slug;
    }
}
