<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_jenis_barang',
        'nama_barang',
        'harga_barang',
        'gambar',
        'lebar_kain',
        'stok',
    ];

    public function jenis_barang()
    {
        return $this->hasOne(jenis_barang::class, 'id', 'id_jenis_barang');
    }
}
