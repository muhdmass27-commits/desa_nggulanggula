<?php
// FILE BARU: app/Http/Controllers/Public/PendudukController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use App\Models\KelompokUmur;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendudukController extends Controller
{
    public function index(Request $request): View
    {
        $daftarTahun = DataPenduduk::aktif()->orderByDesc('tahun')->pluck('tahun');

        $tahun = (int) $request->query('tahun');
        if (! $daftarTahun->contains($tahun)) {
            $tahun = $daftarTahun->first();
        }

        $penduduk = $tahun ? DataPenduduk::aktif()->where('tahun', $tahun)->first() : null;

        return view('public.penduduk', [
            'daftarTahun' => $daftarTahun,
            'tahun' => $tahun,
            'penduduk' => $penduduk,
            'pendidikan' => $tahun ? Pendidikan::where('tahun', $tahun)->orderByDesc('jumlah')->get() : collect(),
            'pekerjaan' => $tahun ? Pekerjaan::where('tahun', $tahun)->orderByDesc('jumlah')->get() : collect(),
            'kelompokUmur' => $tahun ? KelompokUmur::where('tahun', $tahun)->orderBy('id')->get() : collect(),
        ]);
    }
}
