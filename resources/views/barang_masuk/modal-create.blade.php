<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Supplier</label>
                        <select class="form-control" name="id_supplier" id="id_supplier" required>
                            
                           @foreach($suppliers as $supplier)
                            <option selected="selected"  value="{{$supplier->id}}">{{$supplier->nama_supplier}}</option>
                            @endforeach
                            <option selected="selected"  value=" "></option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-supplier"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label><br>
                        <select class="form-control" name="id_barang" id="id_barang" required>
                           @foreach($barangs as $barang)
                            <option selected="selected"  value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                            @endforeach
                            <option selected="selected"  value=" "></option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_barang"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Admin</label>
                        <select class="form-control" name="id_admin" id="id_admin" required>
                           @foreach($admins as $admin)
                            <option selected="selected"  value="{{$admin->id}}">{{$admin->nama_admin}}</option>
                            @endforeach
                            <option selected="selected"  value=" "></option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_admin"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_masuk"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Jumlah Barang Masuk</label>
                        <input type="number" class="form-control" id="jml_brg_masuk" name="jml_brg_masuk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jml_brg_masuk"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
    $('body').on('click', '#btn-create-post', function () {
        $('#modal-create').modal('show');
    });
    $('#store').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        var data = new
        FormData(document.getElementById("formData"));
        data.append("id_supplier", $('#id_supplier').val());
        data.append("id_barang", $('#id_barang').val());
        data.append("id_admin", $('#id_admin').val());
        data.append("tgl_masuk", $('#tgl_masuk').val());
        data.append("jml_brg_masuk", $('#jml_brg_masuk').val());
        $.ajax({
            url: '{{url('api/barang_masuks')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('id_supplier') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let barang_masuks = `
                <tr id="index_${response.data.id}">
                <td>${response.data.id_supplier}</td>
                <td>${response.data.id_barang}</td>
                <td>${response.data.id_admin}</td>
                <td>${response.data.tgl_masuk}</td>
                <td>${response.data.jml_brg_masuk}</td>
                <td class="text-left">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    
                </td>
                </tr>
                `;
                $('#table-barang_masuks').prepend(barang_masuks);
                $('#id_supplier').val('');
                $('#id_barang').val('');
                $('#id_admin').val('');
                $('#tgl_masuk').val('');
                $('#jml_brg_masuk').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.id_supplier[0]) {
                    $('#alert-id_supplier').removeClass('d-none');
                    $('#alert-id_supplier').addClass('d-block');
                    $('#alert-id_supplier').html(error.responseJSON.id_supplier[0]);

                }
                if(error.responseJSON.id_barang[0]) {
                    $('#alert-id_barang').removeClass('d-none');
                    $('#alert-id_barang').addClass('d-block');
                    $('#alert-id_barang').html(error.responseJSON.id_barang[0]);

                }
                if(error.responseJSON.id_admin[0]) {
                    $('#alert-id_admin').removeClass('d-none');
                    $('#alert-id_admin').addClass('d-block');
                    $('#alert-id_admin').html(error.responseJSON.id_admin[0]);

                }
                if(error.responseJSON.tgl_masuk[0]) {
                    $('#alert-tgl_masuk').removeClass('d-none');
                    $('#alert-tgl_masuk').addClass('d-block');
                    $('#alert-tgl_masuk').html(error.responseJSON.tgl_masuk[0]);

                }
            }
        });
        });
</script>