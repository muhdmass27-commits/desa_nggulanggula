<?php
// GANTI SELURUH ISI FILE app/Models/DataPenduduk.php
// Tambahan dari versi Tahap 2: 'keterangan' dan 'status' di $fillable,
// plus scopeAktif() mengikuti pola model lain.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{
    protected $table = 'data_penduduk';

    protected $fillable = [
        'tahun','jumlah_penduduk','jumlah_kk','laki_laki','perempuan',
        'jumlah_dusun','jumlah_rt','jumlah_rw','keterangan','status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
