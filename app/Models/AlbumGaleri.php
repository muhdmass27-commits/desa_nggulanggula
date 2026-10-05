<?php
// GANTI SELURUH ISI FILE app/Models/AlbumGaleri.php
// Tambahan dari versi sebelumnya: relasi fotoTerbaru() (hasOne "latestOfMany")
// untuk mengambil 1 foto sampul per album tanpa query terpisah per baris
// (memperbaiki N+1 query di halaman publik Galeri - lihat laporan Tahap 7).

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AlbumGaleri extends Model
{
    protected $table = 'album_galeri';
    protected $fillable = ['nama','deskripsi','tanggal'];

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class, 'album_id');
    }

    public function fotoTerbaru(): HasOne
    {
        return $this->hasOne(Galeri::class, 'album_id')->latestOfMany('id');
    }
}
