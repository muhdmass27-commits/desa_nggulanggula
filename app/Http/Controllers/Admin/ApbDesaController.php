<?php
// FILE BARU: app/Http/Controllers/Admin/ApbDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApbDesaRequest;
use App\Models\ApbDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApbDesaController extends Controller
{
    public function index(): View
    {
        $apbDesa = ApbDesa::orderByDesc('tahun')->orderBy('kategori')->orderBy('subkategori')->paginate(10);
        return view('admin.transparansi.apb-desa.index', compact('apbDesa'));
    }

    public function create(): View
    {
        return view('admin.transparansi.apb-desa.create');
    }

    public function store(ApbDesaRequest $request): RedirectResponse
    {
        ApbDesa::create($request->validated());
        return redirect()->route('admin.transparansi.apb-desa.index')->with('status', 'Data APB Desa berhasil disimpan.');
    }

    public function edit(ApbDesa $apb_desa): View
    {
        return view('admin.transparansi.apb-desa.edit', ['apbDesa' => $apb_desa]);
    }

    public function update(ApbDesaRequest $request, ApbDesa $apb_desa): RedirectResponse
    {
        $apb_desa->update($request->validated());
        return redirect()->route('admin.transparansi.apb-desa.index')->with('status', 'Perubahan APB Desa berhasil disimpan.');
    }

    public function destroy(ApbDesa $apb_desa): RedirectResponse
    {
        $apb_desa->delete();
        return redirect()->route('admin.transparansi.apb-desa.index')->with('status', 'Data APB Desa berhasil dihapus.');
    }
}
