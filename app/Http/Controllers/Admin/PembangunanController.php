<?php
// FILE BARU: app/Http/Controllers/Admin/PembangunanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PembangunanRequest;
use App\Models\Pembangunan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PembangunanController extends Controller
{
    public function index(): View
    {
        $pembangunan = Pembangunan::orderByDesc('tahun')->orderBy('nama_program')->paginate(10);
        return view('admin.transparansi.pembangunan.index', compact('pembangunan'));
    }

    public function create(): View
    {
        return view('admin.transparansi.pembangunan.create');
    }

    public function store(PembangunanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pembangunan', 'public');
        }

        Pembangunan::create($data);
        return redirect()->route('admin.transparansi.pembangunan.index')->with('status', 'Data pembangunan berhasil disimpan.');
    }

    public function edit(Pembangunan $pembangunan): View
    {
        return view('admin.transparansi.pembangunan.edit', compact('pembangunan'));
    }

    public function update(PembangunanRequest $request, Pembangunan $pembangunan): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($pembangunan->foto) {
                Storage::disk('public')->delete($pembangunan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pembangunan', 'public');
        }

        $pembangunan->update($data);
        return redirect()->route('admin.transparansi.pembangunan.index')->with('status', 'Perubahan data pembangunan berhasil disimpan.');
    }

    public function destroy(Pembangunan $pembangunan): RedirectResponse
    {
        if ($pembangunan->foto) {
            Storage::disk('public')->delete($pembangunan->foto);
        }

        $pembangunan->delete();
        return redirect()->route('admin.transparansi.pembangunan.index')->with('status', 'Data pembangunan berhasil dihapus.');
    }
}
