<?php
// FILE BARU: app/Http/Controllers/Public/PpidController.php
// Daftar informasi publik + formulir permohonan informasi.
// Permohonan disimpan ke tabel `pengaduan` dengan kategori "Permohonan Informasi"
// (tidak membuat tabel baru) sehingga muncul di menu Admin -> Pengaduan.

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StorePermohonanRequest;
use App\Models\Pengaduan;
use App\Models\Ppid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PpidController extends Controller
{
    private const KATEGORI = ['Informasi Berkala', 'Informasi Setiap Saat', 'Informasi Serta Merta', 'Dasar Hukum'];

    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q'));

        $semua = Ppid::published()
            ->when($q !== '', fn ($query) => $query->where('judul', 'like', "%{$q}%"))
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->get();

        $kelompok = [];
        foreach (self::KATEGORI as $kat) {
            $kelompok[$kat] = $semua->where('kategori', $kat)->values();
        }

        return view('public.ppid', compact('kelompok', 'q'));
    }

    public function permohonan(StorePermohonanRequest $request): RedirectResponse
    {
        // Honeypot anti-spam: kolom "website" tersembunyi harus kosong.
        if ($request->filled('website')) {
            return redirect()->to(route('ppid') . '#permohonan')->with('sukses', 'Permohonan Anda telah diterima.');
        }

        $data = $request->validated();

        do {
            $nomor = Pengaduan::buatNomor();
        } while (Pengaduan::where('nomor_pengaduan', $nomor)->exists());

        $isi = ($data['instansi'] ?? null)
            ? "Asal instansi: {$data['instansi']}\n\n{$data['isi']}"
            : $data['isi'];

        Pengaduan::create([
            'nomor_pengaduan' => $nomor,
            'nama' => $data['nama'],
            'telepon' => $data['telepon'],
            'email' => $data['email'] ?? null,
            'kategori' => 'Permohonan Informasi',
            'judul' => 'Permohonan Informasi',
            'isi' => $isi,
            'status' => 'menunggu',
        ]);

        return redirect()->to(route('ppid') . '#permohonan')
            ->with('sukses', "Permohonan informasi berhasil dikirim. Nomor permohonan Anda: {$nomor}. Simpan nomor ini.");
    }
}
