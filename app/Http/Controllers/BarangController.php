<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\jenis_barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate(100);
        return view('barang.list_barang', compact('barangs'));
    }

    /*public function create()
    {
        $jenis_barangs = Jenis_Barang::all();
        return view('barang.modal-create', compact('jenis_barangs'));
    }*/
}
