<?php
// GANTI SELURUH ISI FILE app/Models/PerangkatDesa.php
// Tambahan dari versi Tahap 2: 'bidang' di $fillable.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $table = 'perangkat_desa';

    protected $fillable = [
        'nama','jabatan','bidang','foto','nip','telepon','email','deskripsi','urutan','status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
