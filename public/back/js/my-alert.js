// import {swal} from "sweetalert";

$(document).ready(function(){

    // $('.delete-minuman-alert').on('submit',function(e){
    //     e.preventDefault();

    //     var link = $(this).attr("action");
    //     // var data = $(this).serialize();
    //     // console.log(link);
    //     var nama = $(this).children("#nama_minuman").attr("value");

    //     Swal.fire({
    //         title: 'Apakah anda Yakin ?',
    //         text: "Minuman " + nama + " akan dihapus",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor:'#d33',
    //         confirmButtonText: 'Lanjutkan',
    //         cancelButtonText: 'batalkan',
    //     }).then((result) => {
    //         if (result.value == true) {
    //             $.ajax({
    //                 url: link,
    //                 data: $(this).serialize(),
    //                 type: 'POST',
    //                 success: function(data){
    //                     console.log(data);
    //                     Swal.fire(
    //                         'Hapus Data!',
    //                         'Minuman '+ nama +' berhasil dihapus.',
    //                         'success'
    //                     );
    //                     location.reload(true);
    //                 }
    //             })
    //         }
    //     })
    // });

    // $('.delete-makanan-alert').on('click',function(e){
    //     e.preventDefault();

    //     var form = $(this).parents('form');
    //     var nama = $(this).children("#nama_makanan").attr("value");
    //     Swal.fire({
    //         title: 'Apakah anda Yakin ?',
    //         text: "Makanan " + nama + " akan dihapus",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         showConfirmButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor:'#d33',
    //         confirmButtonText: 'Lanjutkan',
    //         cancelButtonText: 'batalkan',
    //     }).then((result) => {
    //         if (result.value == true) {
    //             console.log('hello');
    //             $('#form-makanan').submit();
    //         }
    //     })
    // });

    $('.btn-keluar').on('click',function(e){
        e.preventDefault();

        Swal.fire({
            title: 'Keluar!',
            text: "Apakah anda yakin ingin keluar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'batalkan',
        }).then((result) => {
            if (result.value == true) {
               window.location.href = '/admin/logout'
            }
        })

    });

    $('.btn-reset-alert').on('click',function(e){
        // e.preventDefault();

        var link = $(this).attr("action");
        var form = $(this).parents('form');

        Swal.fire({
            title: 'Apakah anda Yakin Reset Password?',
            text: "Anda akan logout setelah berhasil",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'batalkan',
        }).then((result) => {
            if (result.value == true) {
              form.submit()
            }
        })
    });
    
});