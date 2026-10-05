<?php
// FILE BARU: app/Http/Controllers/Admin/PelayananController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePelayananRequest;
use App\Http\Requests\Admin\UpdatePelayananRequest;
use App\Models\Pelayanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PelayananController extends Controller
{
    public function index(): View
    {
        $pelayanan = Pelayanan::orderBy('urutan')->orderBy('nama')->paginate(10);

        return view('admin.pelayanan.index', compact('pelayanan'));
    }

    public function create(): View
    {
        return view('admin.pelayanan.create');
    }

    public function store(StorePelayananRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['nama']);
        $data['urutan'] = $data['urutan'] ?? 0;

        Pelayanan::create($data);

        return redirect()->route('admin.pelayanan.index')
            ->with('status', 'Pelayanan berhasil disimpan ke database.');
    }

    public function edit(Pelayanan $pelayanan): View
    {
        return view('admin.pelayanan.edit', compact('pelayanan'));
    }

    public function update(UpdatePelayananRequest $request, Pelayanan $pelayanan): RedirectResponse
    {
        $data = $request->validated();

        if ($data['nama'] !== $pelayanan->nama) {
            $data['slug'] = $this->uniqueSlug($data['nama'], $pelayanan->id);
        }

        $data['urutan'] = $data['urutan'] ?? 0;

        $pelayanan->update($data);

        return redirect()->route('admin.pelayanan.index')
            ->with('status', 'Perubahan pelayanan berhasil disimpan.');
    }

    public function destroy(Pelayanan $pelayanan): RedirectResponse
    {
        $pelayanan->delete();

        return redirect()->route('admin.pelayanan.index')
            ->with('status', 'Pelayanan berhasil dihapus.');
    }

    private function uniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $base = Str::slug($nama) ?: 'pelayanan';
        $slug = $base;
        $i = 2;

        while (
            Pelayanan::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
