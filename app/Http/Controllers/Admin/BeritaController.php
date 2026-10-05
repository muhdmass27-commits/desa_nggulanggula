<?php
// FILE BARU: app/Http/Controllers/Admin/BeritaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBeritaRequest;
use App\Http\Requests\Admin\UpdateBeritaRequest;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    /**
     * Daftar seluruh berita (admin).
     */
    public function index(): View
    {
        $berita = Berita::with('kategori')->latest()->paginate(10);

        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Form tambah berita.
     */
    public function create(): View
    {
        $kategori = KategoriBerita::orderBy('nama')->get();

        return view('admin.berita.create', compact('kategori'));
    }

    /**
     * Simpan berita baru ke database.
     */
    public function store(StoreBeritaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['judul']);
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('status', 'Berita berhasil disimpan ke database.');
    }

    /**
     * Form edit berita.
     */
    public function edit(Berita $berita): View
    {
        $kategori = KategoriBerita::orderBy('nama')->get();

        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    /**
     * Update data berita di database.
     */
    public function update(UpdateBeritaRequest $request, Berita $berita): RedirectResponse
    {
        $data = $request->validated();

        if ($data['judul'] !== $berita->judul) {
            $data['slug'] = $this->uniqueSlug($data['judul'], $berita->id);
        }

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('status', 'Perubahan berita berhasil disimpan.');
    }

    /**
     * Hapus berita dari database.
     */
    public function destroy(Berita $berita): RedirectResponse
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('status', 'Berita berhasil dihapus.');
    }

    /**
     * Buat slug unik dari judul berita.
     */
    private function uniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul) ?: 'berita';
        $slug = $base;
        $i = 2;

        while (
            Berita::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
