<?php
// FILE BARU: app/Http/Controllers/Public/PengaduanController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StorePengaduanRequest;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function index(): View
    {
        return view('public.pengaduan', ['kategori' => StorePengaduanRequest::KATEGORI]);
    }

    public function store(StorePengaduanRequest $request): RedirectResponse
    {
        // Honeypot anti-spam: kolom "website" tersembunyi harus kosong.
        if ($request->filled('website')) {
            return redirect()->route('pengaduan.index')->with('sukses', 'Pengaduan Anda telah diterima.');
        }

        $data = $request->validated();

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('pengaduan', 'public');
        }

        do {
            $nomor = Pengaduan::buatNomor();
        } while (Pengaduan::where('nomor_pengaduan', $nomor)->exists());

        Pengaduan::create($data + ['nomor_pengaduan' => $nomor, 'status' => 'menunggu']);

        return redirect()->route('pengaduan.index')
            ->with('sukses', "Pengaduan berhasil dikirim. Nomor pengaduan Anda: {$nomor}. Simpan nomor ini.");
    }
}
