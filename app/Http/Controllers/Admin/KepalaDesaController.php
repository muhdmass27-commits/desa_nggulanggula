<?php
// FILE BARU: app/Http/Controllers/Admin/KepalaDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KepalaDesaRequest;
use App\Models\KepalaDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class KepalaDesaController extends Controller
{
    public function index(): View
    {
        $kepalaDesa = KepalaDesa::orderBy('urutan')->orderByDesc('id')->paginate(10);

        return view('admin.pemerintahan.kepala-desa.index', compact('kepalaDesa'));
    }

    public function create(): View
    {
        return view('admin.pemerintahan.kepala-desa.create');
    }

    public function store(KepalaDesaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kepala-desa', 'public');
        }

        KepalaDesa::create($data);

        return redirect()->route('admin.pemerintahan.kepala-desa.index')
            ->with('status', 'Data Kepala Desa berhasil disimpan.');
    }

    public function edit(KepalaDesa $kepala_desa): View
    {
        return view('admin.pemerintahan.kepala-desa.edit', ['kepalaDesa' => $kepala_desa]);
    }

    public function update(KepalaDesaRequest $request, KepalaDesa $kepala_desa): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($kepala_desa->foto) {
                Storage::disk('public')->delete($kepala_desa->foto);
            }
            $data['foto'] = $request->file('foto')->store('kepala-desa', 'public');
        }

        $kepala_desa->update($data);

        return redirect()->route('admin.pemerintahan.kepala-desa.index')
            ->with('status', 'Perubahan Kepala Desa berhasil disimpan.');
    }

    public function destroy(KepalaDesa $kepala_desa): RedirectResponse
    {
        if ($kepala_desa->foto) {
            Storage::disk('public')->delete($kepala_desa->foto);
        }

        $kepala_desa->delete();

        return redirect()->route('admin.pemerintahan.kepala-desa.index')
            ->with('status', 'Data Kepala Desa berhasil dihapus.');
    }
}
