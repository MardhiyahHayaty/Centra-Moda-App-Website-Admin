<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_keluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pegawai',
        'id_barang',
        'tgl_keluar',
        'jml_brg_keluar',
    ];

    public function pegawai()
    {
        return $this->hasOne(pegawai::class, 'id', 'id_pegawai');
    }

    public function barang()
    {
        return $this->hasOne(barang::class, 'id', 'id_barang');
    }
}
