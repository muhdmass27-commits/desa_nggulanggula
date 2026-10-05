<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'kategori_id','user_id','judul','slug','ringkasan','isi','gambar',
        'tanggal_publish','status','views',
    ];

    protected function casts(): array
    {
        return ['tanggal_publish' => 'date'];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
