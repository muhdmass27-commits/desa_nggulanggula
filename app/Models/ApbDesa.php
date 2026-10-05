<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbDesa extends Model
{
    protected $table = 'apb_desa';
    protected $fillable = [
        'tahun','kategori','subkategori','deskripsi','anggaran','realisasi','keterangan',
    ];
}
