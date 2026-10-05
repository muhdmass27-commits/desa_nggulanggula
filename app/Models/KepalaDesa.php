<?php
// GANTI SELURUH ISI FILE app/Models/KepalaDesa.php
// Tambahan dari versi Tahap 2: 'periode' dan 'sambutan' di $fillable
// (mengikuti kolom baru dari migration Tahap 4 Bagian 2).

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaDesa extends Model
{
    protected $table = 'kepala_desa';

    protected $fillable = [
        'nama','foto','jabatan','periode','nip','telepon','email','deskripsi','sambutan','urutan','status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
