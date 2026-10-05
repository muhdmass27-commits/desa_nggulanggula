<?php
// FILE BARU: app/Http/Controllers/Admin/WisataController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWisataRequest;
use App\Http\Requests\Admin\UpdateWisataRequest;
use App\Models\Wisata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WisataController extends Controller
{
    public function index(): View
    {
        $wisata = Wisata::latest()->paginate(10);
        return view('admin.informasi-desa.wisata.index', compact('wisata'));
    }

    public function create(): View
    {
        return view('admin.informasi-desa.wisata.create');
    }

    public function store(StoreWisataRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['nama']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        Wisata::create($data);

        return redirect()->route('admin.informasi-desa.wisata.index')
            ->with('status', 'Data wisata berhasil disimpan.');
    }

    public function edit(Wisata $wisata): View
    {
        return view('admin.informasi-desa.wisata.edit', ['wisata' => $wisata]);
    }

    public function update(UpdateWisataRequest $request, Wisata $wisata): RedirectResponse
    {
        $data = $request->validated();

        if ($data['nama'] !== $wisata->nama) {
            $data['slug'] = $this->uniqueSlug($data['nama'], $wisata->id);
        }

        if ($request->hasFile('foto')) {
            if ($wisata->foto) {
                Storage::disk('public')->delete($wisata->foto);
            }
            $data['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        $wisata->update($data);

        return redirect()->route('admin.informasi-desa.wisata.index')
            ->with('status', 'Perubahan data wisata berhasil disimpan.');
    }

    public function destroy(Wisata $wisata): RedirectResponse
    {
        if ($wisata->foto) {
            Storage::disk('public')->delete($wisata->foto);
        }

        $wisata->delete();

        return redirect()->route('admin.informasi-desa.wisata.index')
            ->with('status', 'Data wisata berhasil dihapus.');
    }

    private function uniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $base = Str::slug($nama) ?: 'wisata';
        $slug = $base; $i = 2;
        while (Wisata::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}"; $i++;
        }
        return $slug;
    }
}
