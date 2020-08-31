$(document).ready(function(){

    show_json();

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6b6b3e38541cd58e3b08', {
        cluster: 'ap1',
        forceTLS: true
        });
    
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if(data.message === 'success'){ 
               show_json();
            }
        });

    function show_json(){
        $.ajax({
            url     : '/json',
            type    : 'GET',
            async   : true,
            dataType: 'json',
            success : function(data){
                $('#daftar_menu').html('');
                data['pesanans'].forEach(function(pesanan,i){
                    console.log(pesanan);
                    if(pesanan['tmp_menu'] == 1){
                        var status_menu = 'sedang diproses'
                    } else if (pesanan['tmp_menu'] == 2){
                        var status_menu = 'selesai'
                    }
                    // console.log(pesanan['tmp_menu']);
                    $('#daftar_menu').append(`
                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <div class="item">
                                    <h6>${pesanan['nama_menu']}</h6>
                                    <p style="margin-top: -8px;">${pesanan['quantity']}</p>
                                </div>
                            </div>
                            <div class="col d-flex align-items-center">
                                <p>${status_menu}</p>
                            </div>
                            <div class="col d-flex align-items-left justify-content-end">
                                <p>Rp. ${pesanan['sub_total']}</p>
                            </div>
                        </div>
                    `);
                });

                $('#total').html('');
                $('#total').append(`
                    <div class="row" id="total" style="font-weight: 600;">
                        <div class="col-4" >
                            <div class="item">
                                <h6 style="font-weight: 600;">Total</h6>
                            </div>
                        </div>
                        <div class="col text-right">
                            <p style="font-size: 0.9rem;">Rp. ${data['total_bayar']}</p>
                        </div>
                    </div>
                `);
                
                $('#tombol').html('');
                if(data['tmp_order'] == 0){
                    $('#tombol').append(`
                        <a href="/selesai/cetak/${data['id_order']}" id="bayar" class="btn btn-primary text-uppercase" style="width: 100%;">Cetak Struk</a>
                    `);
                }else if(data['tmp_order'] == 1){
                    $('#tombol').append(`
                        <a href="/selesai/${data['id_order']}" id="bayar" class="btn btn-secondary text-uppercase disabled" style="width: 100%;">Tambah Pesanan</a>
                    `);
                }else{
                    $('#tombol').append(`
                        <a href="/selesai/${data['id_order']}" id="bayar" class="btn btn-pesan text-uppercase" style="width: 100%;">Tambah Pesanan</a>
                    `);
                }
            }
        })
    }

})