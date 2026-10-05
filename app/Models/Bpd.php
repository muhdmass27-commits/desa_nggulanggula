<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpd extends Model
{
    protected $table = 'bpd';

    protected $fillable = [
        'nama','jabatan','foto','telepon','deskripsi','urutan','status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
