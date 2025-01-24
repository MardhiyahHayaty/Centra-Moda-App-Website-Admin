<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT DATA BARANG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">
                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="id_jenis_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-id_jenis_barang-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_barang-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Harga Barang</label>
                        <input type="number" class="form-control" id="harga_barang-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_barang-edit"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="control-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar-edit">
                        <img id="image" width="50" height="50">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-gambar-edit"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Lebar Kain</label>
                        <input type="number" class="form-control" id="lebar_kain-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lebar_kain-edit"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Stok</label>
                        <input type="number" class="form-control" id="stok-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok-edit"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="update">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
//button create post event
$('body').on('click', '#btn-edit-post', function () {
    let post_id = $(this).data('id');
    //fetch detail post with ajax
    $.ajax({
        url: '{{url('api/barangs')}}/'+post_id,
        type: "GET",
        cache: false,
        success:function(response){
            //fill data to form
            $('#post_id').val(response.data.id);
            $('#id_jenis_barang-edit').val(response.data.id_jenis_barang);
            $('#nama_barang-edit').val(response.data.nama_barang);
            $('#harga_barang-edit').val(response.data.harga_barang);
            $('#lebar_kain-edit').val(response.data.lebar_kain);
            $('#stok-edit').val(response.data.stok);
            $('#gambar-edit').attr("src","{{ url('storage/barangs')}}"+"/"+response.data.gambar);
            console.log(response.data.gambar)
            //open modal
            $('#modal-edit').modal('show');
        }
    });
});
//action update post
$('#update').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    let post_id=$('#post_id').val()
    var form = new FormData();
    form.append("id_jenis_barang",$('#id_jenis_barang-edit').val());
    form.append("nama_barang", $('#nama_barang-edit').val());
    form.append("harga_barang",$('#harga_barang-edit').val());
    form.append("lebar_kain", $('#lebar_kain-edit').val());
    form.append("stok", $('#stok-edit').val());
    form.append("gambar", $('input[id="gambar-edit"]')[0].files[0]);
    form.append("_method", "PUT");
//ajax
$.ajax({
    url: '{{url('api/barangs')}}/'+post_id,
    type: "POST",
    data: form,
    cache: false,
    dataType: 'json',
    processData: false,
    contentType: false,
    timeout: 0,
    mimeType: "multipart/form-data",
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('id_jenis_barang') },
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
        let post = `
        <tr id="index_${response.data.id}">
        <td>${response.data.id_jenis_barang}</td>
        <td>${response.data.nama_barang}</td>
        <td>${response.data.harga_barang}</td>
        
        <td>
        <img src="{{ url('storage/barangs')}}${"/"+response.data.gambar}" width=50 height=50>
        </td>
        <td>${response.data.lebar_kain}</td>
        <td>${response.data.stok}</td>

        <td class="text-left">
        <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
        
        </td>
        </tr>
        `;
//append to post data
$(`#index_${response.data.id}`).replaceWith(post);
//close modal
$('#modal-edit').modal('hide');

},
error:function(error){
    console.log(error)
if(error.responseJSON.id_jenis_barang[0]) {
//show alert
$('#alert-id_jenis_barang-edit').removeClass('d-none');
$('#alert-id_jenis_barang-edit').addClass('d-block');
//add message to alert
$('#alert-id_jenis_barang-edit').html(error.responseJSON.id_jenis_barang[0]);

}
if(error.responseJSON.nama_barang[0]) {
//show alert
$('#alert-nama_barang-edit').removeClass('d-none');
$('#alert-nama_barang-edit').addClass('d-block');
//add message to alert

$('#alert-nama_barang-edit').html(error.responseJSON.nama_barang[0]);

}
if(error.responseJSON.harga_barang[0]) {
//show alert
$('#alert-harga_barang-edit').removeClass('d-none');
$('#alert-harga_barang-edit').addClass('d-block');
//add message to alert

$('#alert-harga_barang-edit').html(error.responseJSON.harga_barang[0]);
}

if(error.responseJSON.lebar_kain[0]) {
//show alert
$('#alert-lebar_kain-edit').removeClass('d-none');
$('#alert-lebar_kain-edit').addClass('d-block');
//add message to alert

$('#alert-lebar_kain-edit').html(error.responseJSON.lebar_kain[0]);

}
if(error.responseJSON.stok[0]) {
//show alert
$('#alert-stok-edit').removeClass('d-none');
$('#alert-stok-edit').addClass('d-block');
//add message to alert

$('#alert-stok-edit').html(error.responseJSON.stok[0]);

}
}
});
});
</script>