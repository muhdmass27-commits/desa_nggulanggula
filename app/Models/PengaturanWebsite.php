<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWebsite extends Model
{
    protected $table = 'pengaturan_website';
    protected $fillable = [
        'nama_website','nama_desa','tagline','logo','favicon','deskripsi',
        'footer','facebook','instagram','youtube','whatsapp',
    ];
}
