<?php
// FILE BARU: app/Http/Controllers/Admin/DataPendudukController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataPendudukRequest;
use App\Models\DataPenduduk;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DataPendudukController extends Controller
{
    public function index(): View
    {
        $dataPenduduk = DataPenduduk::orderByDesc('tahun')->paginate(10);

        return view('admin.penduduk.index', compact('dataPenduduk'));
    }

    public function create(): View
    {
        return view('admin.penduduk.create');
    }

    public function store(DataPendudukRequest $request): RedirectResponse
    {
        DataPenduduk::create($request->validated());

        return redirect()->route('admin.penduduk.index')
            ->with('status', 'Data penduduk berhasil disimpan.');
    }

    public function edit(DataPenduduk $data_penduduk): View
    {
        return view('admin.penduduk.edit', ['dataPenduduk' => $data_penduduk]);
    }

    public function update(DataPendudukRequest $request, DataPenduduk $data_penduduk): RedirectResponse
    {
        $data_penduduk->update($request->validated());

        return redirect()->route('admin.penduduk.index')
            ->with('status', 'Perubahan data penduduk berhasil disimpan.');
    }

    public function destroy(DataPenduduk $data_penduduk): RedirectResponse
    {
        $data_penduduk->delete();

        return redirect()->route('admin.penduduk.index')
            ->with('status', 'Data penduduk berhasil dihapus.');
    }
}
