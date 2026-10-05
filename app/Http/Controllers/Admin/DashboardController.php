<?php
// GANTI SELURUH ISI FILE app/Http/Controllers/Admin/DashboardController.php
// Versi gabungan Kelompok A + Kelompok B-1 - menambah hitungan Potensi & Wisata
// yang kini sudah benar-benar dari database (bukan model kosong seperti sebelumnya).

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Bpd;
use App\Models\DataPenduduk;
use App\Models\Galeri;
use App\Models\Pelayanan;
use App\Models\Pengaduan;
use App\Models\PerangkatDesa;
use App\Models\PotensiDesa;
use App\Models\Wisata;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $ringkasan = [
            'berita_total' => Berita::count(),
            'berita_published' => Berita::published()->count(),
            'berita_draft' => Berita::where('status', 'draft')->count(),
            'pelayanan_total' => Pelayanan::count(),
            'perangkat_total' => PerangkatDesa::count(),
            'bpd_total' => Bpd::count(),
            'potensi_total' => PotensiDesa::count(),
            'potensi_published' => PotensiDesa::where('status', 'published')->count(),
            'wisata_total' => Wisata::count(),
            'wisata_published' => Wisata::where('status', 'published')->count(),
            'galeri_total' => Galeri::count(),
            'pengaduan_menunggu' => Pengaduan::where('status', 'menunggu')->count(),
            'penduduk_terbaru' => DataPenduduk::orderByDesc('tahun')->first(),
        ];

        return view('admin.dashboard', compact('ringkasan'));
    }
}
