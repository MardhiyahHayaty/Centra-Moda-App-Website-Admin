<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_barang extends Model
{
    use HasFactory;
    protected $table = 'jenis_barangs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_barang',
    ];
    
}
