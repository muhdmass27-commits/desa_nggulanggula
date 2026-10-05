<?php
// FILE BARU: app/Http/Controllers/Admin/PekerjaanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PekerjaanRequest;
use App\Models\Pekerjaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PekerjaanController extends Controller
{
    public function index(): View
    {
        $pekerjaan = Pekerjaan::orderByDesc('tahun')->orderBy('jenis_pekerjaan')->paginate(10);
        return view('admin.penduduk.pekerjaan.index', compact('pekerjaan'));
    }

    public function create(): View
    {
        return view('admin.penduduk.pekerjaan.create');
    }

    public function store(PekerjaanRequest $request): RedirectResponse
    {
        Pekerjaan::create($request->validated());
        return redirect()->route('admin.penduduk.pekerjaan.index')->with('status', 'Data pekerjaan berhasil disimpan.');
    }

    public function edit(Pekerjaan $pekerjaan): View
    {
        return view('admin.penduduk.pekerjaan.edit', compact('pekerjaan'));
    }

    public function update(PekerjaanRequest $request, Pekerjaan $pekerjaan): RedirectResponse
    {
        $pekerjaan->update($request->validated());
        return redirect()->route('admin.penduduk.pekerjaan.index')->with('status', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Pekerjaan $pekerjaan): RedirectResponse
    {
        $pekerjaan->delete();
        return redirect()->route('admin.penduduk.pekerjaan.index')->with('status', 'Data berhasil dihapus.');
    }
}
