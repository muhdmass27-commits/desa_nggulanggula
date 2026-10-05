<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';
    protected $fillable = [
        'nama','slug','kategori','deskripsi','persyaratan','prosedur',
        'waktu_pelayanan','biaya','kontak','status','urutan',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
