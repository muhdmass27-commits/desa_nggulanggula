<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';

    protected $fillable = [
        'nama_desa','kecamatan','kabupaten','provinsi','kode_pos','alamat','email','telepon',
        'whatsapp','website','logo','foto_kantor','sejarah','visi','misi','kondisi_geografis',
        'luas_wilayah','batas_utara','batas_selatan','batas_timur','batas_barat','latitude','longitude',
    ];
}
