<?php
// FILE BARU: app/Http/Controllers/Public/TransparansiController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ApbDesa;
use App\Models\Pembangunan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransparansiController extends Controller
{
    private const KATEGORI = ['Pendapatan', 'Belanja', 'Pembiayaan'];

    public function index(Request $request): View
    {
        $daftarTahun = ApbDesa::query()->pluck('tahun')
            ->merge(Pembangunan::query()->pluck('tahun'))
            ->unique()->sortDesc()->values();

        $tahun = (int) $request->query('tahun');
        if (! $daftarTahun->contains($tahun)) {
            $tahun = $daftarTahun->first();
        }

        $apb = $tahun ? ApbDesa::where('tahun', $tahun)->orderBy('subkategori')->get() : collect();

        $ringkasan = [];
        foreach (self::KATEGORI as $kat) {
            $baris = $apb->where('kategori', $kat);
            $anggaran = (int) $baris->sum('anggaran');
            $realisasi = (int) $baris->sum('realisasi');
            $ringkasan[$kat] = [
                'baris' => $baris,
                'anggaran' => $anggaran,
                'realisasi' => $realisasi,
                'persen' => $anggaran > 0 ? min(100, round($realisasi / $anggaran * 100, 1)) : 0,
            ];
        }

        // Surplus/defisit dihitung hanya bila data Pendapatan & Belanja sama-sama ada.
        $selisih = ($ringkasan['Pendapatan']['baris']->isNotEmpty() && $ringkasan['Belanja']['baris']->isNotEmpty())
            ? $ringkasan['Pendapatan']['anggaran'] - $ringkasan['Belanja']['anggaran']
            : null;

        $pembangunan = $tahun ? Pembangunan::where('tahun', $tahun)->orderBy('nama_program')->get() : collect();

        return view('public.transparansi', compact('daftarTahun', 'tahun', 'ringkasan', 'selisih', 'pembangunan'));
    }
}
