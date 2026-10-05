<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotensiDesa extends Model
{
    protected $table = 'potensi_desa';
    protected $fillable = [
        'kategori_id','nama','slug','foto','deskripsi','lokasi','pengelola','kontak','status',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPotensi::class, 'kategori_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
