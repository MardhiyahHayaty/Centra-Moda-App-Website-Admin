<!-- Modal -->

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TAMBAH BARANG</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formData" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="name" class="control-label">Jenis Barang</label>
                    <input type="text" class="form-control" id="id_jenis_barang" name="id_jenis_barang">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_jenis_barang"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_barang"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Harga Barang</label>
                    <input type="number" class="form-control" id="harga_barang" name="harga_barang">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_barang"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
                <div class="form-group">
                    <label class="control-label">Lebar Kain</label>
                    <input type="number" class="form-control" id="lebar_kain" name="lebar_kain">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lebar_kain"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="control-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok"></div>
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
//button create post event
$('body').on('click', '#btn-create-post', function () {
    //open modal
    $('#modal-create').modal('show');
});
//action create post
$('#store').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    var data = new
    FormData(document.getElementById("formData"));
    data.append('gambar', $('input[id="gambar"]')[0].files[0]);
    data.append("id_jenis_barang", $('#id_jenis_barang').val());
    data.append("nama_barang", $('#nama_barang').val());
    data.append("harga_barang", $('#harga_barang').val());
    data.append("lebar_kain",$('#lebar_kain').val());
    data.append("stok",$('#stok').val());
    //ajax
    $.ajax({
        url: '{{url('api/barangs')}}',
        type: "POST",
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout: 0,
        mimeType: "multipart/form-data",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('nama_barang') },
        
        success:function(response){
            //show success message
            Swal.fire({
                type: 'success',
                icon: 'success',
                title: `${response.message}`,
                showConfirmButton: false,
                timer: 3000
            });
            //data post
            let barang = `
                <tr id="index_${response.data.id}">
                    <td>${response.data.id_jenis_barang}</td>
                    <td>${response.data.nama_barang}</td>
                    <td>${response.data.harga_barang}</td>
                    <td><img src="{{ url('storage/barangs')}}${"/"+response.data.gambar}"></td>
                    <td>${response.data.lebar_kain}</td>
                    <td>${response.data.stok}</td>
                    <td class="text-left">
                        <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                       
                    </td>
                </tr>
            `;
            //append to table
            $('#table-barangs').prepend(barang);
            //clear form
            $('#id_jenis_barang').val('');
            $('#nama_barang').val('');
            $('#harga_barang').val('');
            $('#lebar_kain').val('');
            $('#stok').val('');
            $('#gambar').val('');
            //close modal
            $('#modal-create').modal('hide');
        },
        
        error:function(error){
            for (const value of data.values()) {
                    console.log(value);
                }
                if(error.responseJSON.id_jenis_barang[0]) {
                    $('#alert-id_jenis_barang').removeClass('d-none');
                    $('#alert-id_jenis_barang').addClass('d-block');
                    $('#alert-id_jenis_barang').html(error.responseJSON.id_jenis_barang[0]);

                }
                if(error.responseJSON.nama_barang[0]) {
                    $('#alert-nama_barang').removeClass('d-none');
                    $('#alert-nama_barang').addClass('d-block');
                    $('#alert-nama_barang').html(error.responseJSON.nama_barang[0]);

                }
                if(error.responseJSON.harga_barang[0]) {
                    $('#alert-harga_barang').removeClass('d-none');
                    $('#alert-harga_barang').addClass('d-block');
                    $('#alert-harga_barang').html(error.responseJSON.harga_barang[0]);

                }
                
                if(error.responseJSON.lebar_kain[0]) {
                    $('#alert-lebar_kain').removeClass('d-none');
                    $('#alert-lebar_kain').addClass('d-block');
                    $('#alert-lebar_kain').html(error.responseJSON.lebar_kain[0]);

                }
                if(error.responseJSON.stok[0]) {
                    $('#alert-stok').removeClass('d-none');
                    $('#alert-stok').addClass('d-block');
                    $('#alert-stok').html(error.responseJSON.stok[0]);

                }
        }
    });
});
</script>