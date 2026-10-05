<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppid extends Model
{
    protected $table = 'ppid';
    protected $fillable = ['judul','kategori','deskripsi','file','tanggal','status'];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
