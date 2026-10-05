<?php
// FILE BARU: app/Http/Controllers/Admin/PerangkatDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PerangkatDesaRequest;
use App\Models\PerangkatDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PerangkatDesaController extends Controller
{
    public function index(): View
    {
        $perangkatDesa = PerangkatDesa::orderBy('urutan')->orderBy('nama')->paginate(10);

        return view('admin.pemerintahan.perangkat-desa.index', compact('perangkatDesa'));
    }

    public function create(): View
    {
        return view('admin.pemerintahan.perangkat-desa.create');
    }

    public function store(PerangkatDesaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('perangkat-desa', 'public');
        }

        PerangkatDesa::create($data);

        return redirect()->route('admin.pemerintahan.perangkat-desa.index')
            ->with('status', 'Data Perangkat Desa berhasil disimpan.');
    }

    public function edit(PerangkatDesa $perangkat_desa): View
    {
        return view('admin.pemerintahan.perangkat-desa.edit', ['perangkatDesa' => $perangkat_desa]);
    }

    public function update(PerangkatDesaRequest $request, PerangkatDesa $perangkat_desa): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($perangkat_desa->foto) {
                Storage::disk('public')->delete($perangkat_desa->foto);
            }
            $data['foto'] = $request->file('foto')->store('perangkat-desa', 'public');
        }

        $perangkat_desa->update($data);

        return redirect()->route('admin.pemerintahan.perangkat-desa.index')
            ->with('status', 'Perubahan Perangkat Desa berhasil disimpan.');
    }

    public function destroy(PerangkatDesa $perangkat_desa): RedirectResponse
    {
        if ($perangkat_desa->foto) {
            Storage::disk('public')->delete($perangkat_desa->foto);
        }

        $perangkat_desa->delete();

        return redirect()->route('admin.pemerintahan.perangkat-desa.index')
            ->with('status', 'Data Perangkat Desa berhasil dihapus.');
    }
}
