<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembangunan extends Model
{
    protected $table = 'pembangunan';
    protected $fillable = [
        'tahun','nama_program','lokasi','anggaran','sumber_dana','progress','status','foto','deskripsi',
    ];
}
