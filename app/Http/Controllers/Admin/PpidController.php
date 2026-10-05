<?php
// FILE BARU: app/Http/Controllers/Admin/PpidController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PpidRequest;
use App\Models\Ppid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PpidController extends Controller
{
    public function index(): View
    {
        $ppid = Ppid::orderByDesc('tanggal')->orderByDesc('id')->paginate(10);
        return view('admin.ppid.index', compact('ppid'));
    }

    public function create(): View
    {
        return view('admin.ppid.create');
    }

    public function store(PpidRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('ppid', 'public');
        }

        Ppid::create($data);
        return redirect()->route('admin.ppid.index')->with('status', 'Informasi PPID berhasil disimpan.');
    }

    public function edit(Ppid $ppid): View
    {
        return view('admin.ppid.edit', compact('ppid'));
    }

    public function update(PpidRequest $request, Ppid $ppid): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($ppid->file) {
                Storage::disk('public')->delete($ppid->file);
            }
            $data['file'] = $request->file('file')->store('ppid', 'public');
        } else {
            unset($data['file']);
        }

        $ppid->update($data);
        return redirect()->route('admin.ppid.index')->with('status', 'Perubahan informasi PPID berhasil disimpan.');
    }

    public function destroy(Ppid $ppid): RedirectResponse
    {
        if ($ppid->file) {
            Storage::disk('public')->delete($ppid->file);
        }

        $ppid->delete();
        return redirect()->route('admin.ppid.index')->with('status', 'Informasi PPID berhasil dihapus.');
    }
}
