<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokUmur extends Model
{
    protected $table = 'kelompok_umur';
    protected $fillable = ['tahun','rentang_usia','jumlah'];
}
