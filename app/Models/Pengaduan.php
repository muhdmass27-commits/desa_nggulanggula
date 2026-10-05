<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    protected $fillable = [
        'nomor_pengaduan','nama','telepon','email','kategori','judul','isi',
        'lokasi','lampiran','status','tanggapan','tanggal_tanggapan',
    ];

    protected function casts(): array
    {
        return ['tanggal_tanggapan' => 'datetime'];
    }

    public static function buatNomor(): string
    {
        return 'PGD-' . now()->format('Ymd') . '-' . str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    }
}
