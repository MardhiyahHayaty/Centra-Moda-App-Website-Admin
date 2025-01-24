<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"id="exampleModalLabel">Tambah Jenis Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Jenis Barang</label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jenis_barang"></div>
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
        data.append("jenis_barang", $('#jenis_barang').val());
        $.ajax({
            url: '{{url('api/jenis_barangs')}}',
            type: "POST",
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('jenis_barang') },

            success:function(response){
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                let jenis_barangs = `
                <tr id="index_${response.data.id}">
                <td>${response.data.jenis_barang}</td>

                <td class="text-left">
                    <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                    
                </td>
                </tr>
                `;
                $('#table-posts').prepend(post);
                $('#jenis_barang').val('');
                $('#modal-create').modal('hide');
            },
            error:function(error){
                console.log(error.responseText)
                if(error.responseJSON.jenis_barang[0]) {
                    $('#alert-jenis_barang').removeClass('d-none');
                    $('#alert-jenis_barang').addClass('d-block');
                    $('#alert-jenis_barang').html(error.responseJSON.jenis_barang[0]);

                }
            }
        });
        });
</script>