<?php
// FILE BARU: app/Http/Controllers/Admin/BpdController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BpdRequest;
use App\Models\Bpd;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BpdController extends Controller
{
    public function index(): View
    {
        $bpd = Bpd::orderBy('urutan')->orderBy('nama')->paginate(10);

        return view('admin.pemerintahan.bpd.index', compact('bpd'));
    }

    public function create(): View
    {
        return view('admin.pemerintahan.bpd.create');
    }

    public function store(BpdRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bpd', 'public');
        }

        Bpd::create($data);

        return redirect()->route('admin.pemerintahan.bpd.index')
            ->with('status', 'Data BPD berhasil disimpan.');
    }

    public function edit(Bpd $bpd): View
    {
        return view('admin.pemerintahan.bpd.edit', compact('bpd'));
    }

    public function update(BpdRequest $request, Bpd $bpd): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($bpd->foto) {
                Storage::disk('public')->delete($bpd->foto);
            }
            $data['foto'] = $request->file('foto')->store('bpd', 'public');
        }

        $bpd->update($data);

        return redirect()->route('admin.pemerintahan.bpd.index')
            ->with('status', 'Perubahan data BPD berhasil disimpan.');
    }

    public function destroy(Bpd $bpd): RedirectResponse
    {
        if ($bpd->foto) {
            Storage::disk('public')->delete($bpd->foto);
        }

        $bpd->delete();

        return redirect()->route('admin.pemerintahan.bpd.index')
            ->with('status', 'Data BPD berhasil dihapus.');
    }
}
