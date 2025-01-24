<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_masuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_supplier',
        'id_barang',
        'id_admin',
        'tgl_masuk',
        'jml_brg_masuk',
    ];

    public function supplier()
    {
        return $this->hasOne(supplier::class, 'id', 'id_supplier');
    }

    public function barang()
    {
        return $this->hasOne(barang::class, 'id', 'id_barang');
    }

    public function admin()
    {
        return $this->hasOne(admin::class, 'id', 'id_admin');
    }
}
