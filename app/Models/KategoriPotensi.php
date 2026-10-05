<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPotensi extends Model
{
    protected $table = 'kategori_potensi';
    protected $fillable = ['nama','slug'];

    public function potensi(): HasMany
    {
        return $this->hasMany(PotensiDesa::class, 'kategori_id');
    }
}
