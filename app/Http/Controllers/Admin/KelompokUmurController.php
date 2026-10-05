<?php
// FILE BARU: app/Http/Controllers/Admin/KelompokUmurController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KelompokUmurRequest;
use App\Models\KelompokUmur;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KelompokUmurController extends Controller
{
    public function index(): View
    {
        $kelompokUmur = KelompokUmur::orderByDesc('tahun')->orderBy('rentang_usia')->paginate(10);
        return view('admin.penduduk.kelompok-umur.index', compact('kelompokUmur'));
    }

    public function create(): View
    {
        return view('admin.penduduk.kelompok-umur.create');
    }

    public function store(KelompokUmurRequest $request): RedirectResponse
    {
        KelompokUmur::create($request->validated());
        return redirect()->route('admin.penduduk.kelompok-umur.index')->with('status', 'Data kelompok umur berhasil disimpan.');
    }

    public function edit(KelompokUmur $kelompok_umur): View
    {
        return view('admin.penduduk.kelompok-umur.edit', ['kelompokUmur' => $kelompok_umur]);
    }

    public function update(KelompokUmurRequest $request, KelompokUmur $kelompok_umur): RedirectResponse
    {
        $kelompok_umur->update($request->validated());
        return redirect()->route('admin.penduduk.kelompok-umur.index')->with('status', 'Perubahan berhasil disimpan.');
    }

    public function destroy(KelompokUmur $kelompok_umur): RedirectResponse
    {
        $kelompok_umur->delete();
        return redirect()->route('admin.penduduk.kelompok-umur.index')->with('status', 'Data berhasil dihapus.');
    }
}
