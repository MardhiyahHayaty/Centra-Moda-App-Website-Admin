<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang_masuk;
use App\Models\barang;
use App\Models\supplier;
use App\Models\admin;
use DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        
        $barang_masuks = Barang_masuk::join('barangs', 'barangs.id', '=', 'barang_masuks.id_barang')
                    ->select('barang_masuks.*', 'barangs.nama_barang')
                    ->join('suppliers', 'barang_masuks.id_supplier', '=', 'suppliers.id')
                    ->select('barang_masuks.*', 'suppliers.nama_supplier')
                    ->join('admins', 'barang_masuks.id_admin', '=', 'admins.id')
                    ->select('barang_masuks.*', 'admins.nama_admin')
                    ->paginate(100);

        $barangs = Barang::all();
        $suppliers = Supplier::all();
        $admins = Admin::all();
        return view('barang_masuk.list_barang_masuk', compact('barangs', 'suppliers', 'admins', 'barang_masuks'));

        
        //return view('barang_masuk.list_barang_masuk', compact('suppliers', 'barang_masuks'));

        /*$barang_masuks = Barang_Masuk::latest()->paginate(5);
        return view('barang_masuk.list_barang_masuk', compact('barang_masuks'));*/
    }
}
