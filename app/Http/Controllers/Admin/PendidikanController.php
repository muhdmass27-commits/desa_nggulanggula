<?php
// FILE BARU: app/Http/Controllers/Admin/PendidikanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PendidikanRequest;
use App\Models\Pendidikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PendidikanController extends Controller
{
    public function index(): View
    {
        $pendidikan = Pendidikan::orderByDesc('tahun')->orderBy('jenjang')->paginate(10);
        return view('admin.penduduk.pendidikan.index', compact('pendidikan'));
    }

    public function create(): View
    {
        return view('admin.penduduk.pendidikan.create');
    }

    public function store(PendidikanRequest $request): RedirectResponse
    {
        Pendidikan::create($request->validated());
        return redirect()->route('admin.penduduk.pendidikan.index')->with('status', 'Data pendidikan berhasil disimpan.');
    }

    public function edit(Pendidikan $pendidikan): View
    {
        return view('admin.penduduk.pendidikan.edit', compact('pendidikan'));
    }

    public function update(PendidikanRequest $request, Pendidikan $pendidikan): RedirectResponse
    {
        $pendidikan->update($request->validated());
        return redirect()->route('admin.penduduk.pendidikan.index')->with('status', 'Perubahan berhasil disimpan.');
    }

    public function destroy(Pendidikan $pendidikan): RedirectResponse
    {
        $pendidikan->delete();
        return redirect()->route('admin.penduduk.pendidikan.index')->with('status', 'Data berhasil dihapus.');
    }
}
