<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jenis_barang;
use App\Http\Resources\JenisBarangResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_barangs = Jenis_Barang::latest()->paginate(5);
        return new JenisBarangResource(true, 'List Data Jenis Barang', $jenis_barangs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jenis_barang = Jenis_Barang::create([
            'jenis_barang' => $request->jenis_barang,
        ]);

        return new JenisBarangResource(true, 'Data Jenis Barang Berhasil Ditambahkan!', $jenis_barang);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis_Barang $jenis_barang)
    {
        return new JenisBarangResource(true, 'Data Jenis Barang Ditemukan!', $jenis_barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis_Barang $jenis_barang)
    {
        $validator = Validator::make($request->all(), [
            'jenis_barang' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $jenis_barang->update([
                'jenis_barang' => $request->jenis_barang,
            ]);
        } else {

            $jenis_barang->update([
                'jenis_barang' => $request->jenis_barang,
            ]);
        }
        return new JenisBarangResource(true, 'Data JenisBarang Berhasil Diubah!', $jenis_barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis_Barang $jenis_barang)
    {
        $jenis_barang->delete();
        return new JenisBarangResource(true, 'Data JenisBarang Berhasil Dihapus!', null);
    }
}
