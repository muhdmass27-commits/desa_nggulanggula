<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $fillable = [
        'nama','slug','foto','deskripsi','lokasi','latitude','longitude',
        'fasilitas','jam_buka','jam_tutup','kontak_pengelola','status',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
