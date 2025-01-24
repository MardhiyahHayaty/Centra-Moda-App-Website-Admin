<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang_keluar;
use App\Models\barang;
use App\Models\pegawai;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluars = Barang_keluar::join('barangs', 'barangs.id', '=', 'barang_keluars.id_barang')
                    ->select('barang_keluars.*', 'barangs.nama_barang')
                    ->join('pegawais', 'barang_keluars.id_pegawai', '=', 'pegawais.id')
                    ->select('barang_keluars.*', 'pegawais.nama_pegawai')
                    ->paginate(100);

        $barangs = Barang::all();
        $pegawais = Pegawai::all();
        return view('barang_keluar.list_barang_keluar', compact('barangs', 'pegawais', 'barang_keluars'));
        /*$barang_keluars = Barang_Keluar::latest()->paginate(5);
        return view('barang_keluar.list_barang_keluar', compact('barang_keluars'));*/
    }
}
