@extends('layouts.jenis_barang')
@section('title','List Data Jenis Barang')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax Jenis Barang</title>
    
    <style>
    body {
        background-color: lightgray !important;
    }
    </style>
    @section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endsection
</head>

<body>
@section('content')
    <div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Tabel Jenis Barang </h4>
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Jenis Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-jenis_barangs">
                            @foreach($jenis_barangs as $jenis_barang)
                            <tr id="index_{{ $jenis_barang->id }}">
                                <td>{{ $jenis_barang-> jenis_barang }}</td>
                                <td class="text-left">
                                <a href="javascript:void(0)"id="btn-edit-post" data-id="{{ $jenis_barang->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                <!--<a href="javascript:void(0)"id="btn-delete-post" data-id="{{ $jenis_barang->id }}" class="btn btn-danger btn-sm">DELETE</a>-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@include('jenis_barang.modal-create')
@include('jenis_barang.update')
@include('jenis_barang.delete')
@endsection
</body>
</html>