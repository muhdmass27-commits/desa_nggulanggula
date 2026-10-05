<?php
// FILE BARU: app/Http/Controllers/Admin/PengaduanController.php
// Sisi ADMIN saja: lihat daftar, buka detail, ubah status + tanggapan, hapus.
// (Form pengiriman pengaduan oleh masyarakat dibuat di tahap halaman publik.)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePengaduanRequest;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    private const STATUS = ['menunggu', 'diproses', 'selesai', 'ditolak'];

    public function index(Request $request): View
    {
        $filter = in_array($request->query('status'), self::STATUS, true) ? $request->query('status') : null;

        $pengaduan = Pengaduan::query()
            ->when($filter, fn ($q) => $q->where('status', $filter))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $hitung = Pengaduan::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('admin.pengaduan.index', compact('pengaduan', 'filter', 'hitung'));
    }

    public function show(Pengaduan $pengaduan): View
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function update(UpdatePengaduanRequest $request, Pengaduan $pengaduan): RedirectResponse
    {
        $data = $request->validated();

        // Catat waktu tanggapan hanya jika tanggapan diisi dan berubah.
        if (! empty($data['tanggapan']) && $data['tanggapan'] !== $pengaduan->tanggapan) {
            $data['tanggal_tanggapan'] = now();
        }

        $pengaduan->update($data);

        return redirect()->route('admin.pengaduan.show', $pengaduan)
            ->with('status', 'Status dan tanggapan pengaduan berhasil disimpan.');
    }

    public function destroy(Pengaduan $pengaduan): RedirectResponse
    {
        if ($pengaduan->lampiran) {
            Storage::disk('public')->delete($pengaduan->lampiran);
        }

        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')->with('status', 'Pengaduan berhasil dihapus.');
    }
}
