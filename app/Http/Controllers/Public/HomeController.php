<?php
// FILE BARU: app/Http/Controllers/Public/HomeController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\DataPenduduk;
use App\Models\Galeri;
use App\Models\KepalaDesa;
use App\Models\Pelayanan;
use App\Models\PotensiDesa;
use App\Models\Wisata;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('public.home', [
            'kepalaDesa' => KepalaDesa::aktif()->orderBy('urutan')->orderByDesc('id')->first(),
            'penduduk' => DataPenduduk::aktif()->orderByDesc('tahun')->first(),
            'berita' => Berita::published()->with('kategori')->orderByDesc('tanggal_publish')->orderByDesc('id')->limit(3)->get(),
            'pelayanan' => Pelayanan::aktif()->orderBy('urutan')->orderBy('nama')->limit(4)->get(),
            'potensi' => PotensiDesa::published()->with('kategori')->latest()->limit(3)->get(),
            'wisata' => Wisata::published()->latest()->limit(3)->get(),
            'galeri' => Galeri::latest()->limit(6)->get(),
        ]);
    }
}
