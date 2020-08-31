$(document).ready(function(){

    $('.btn-delete').on('click',function(e){
        e.preventDefault();

        var link = $(this).attr("href");

        Swal.fire({
            title: 'Apakah anda Yakin ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor:'#d33',
            confirmBUttonText: 'Lanjutkan'
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    type: 'POST',
                    success: function(data){
                        // alert(data);
                        console.log(data);
                        Swal.fire(
                            'Hapus Data!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                        location.reload(true);
                    }
                })
            }
        })
    });
    
});