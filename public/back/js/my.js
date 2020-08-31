$(document).ready(function(){


    show_meja();
    
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('6b6b3e38541cd58e3b08', {
    cluster: 'ap1',
    forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if(data.message === 'success'){ 
           show_meja();
        }
    });

    function show_meja(){
        $.ajax({
            url     : '/admin/home/meja',
            type    : 'GET',
            async   : true,
            dataType: 'json',
            success : function(data){
                $('#meja').html('');
                console.log(data);
                data['items'].forEach(function(item,i){
                   console.log(item);
                   if(item['j_pelanggan'] == 0){
                        $('#meja').append(`
                            <div class="col-lg-3 col-md-12 col-sm-12 px-5 py-4 mx-4 mb-5 bg-secondary rounded shadow">
                                <h6 class="text-center mb-1">Lantai ${item['lantai']}</h6>
                                <h4 class="text-center mb-1">${item['nama_meja']}</h4>
                                <h6 class="text-center">tidak ada pesanan</h6>
                            </div> 
                        `);
                    } else {
                        $('#meja').append(`
                            <div class="col-lg-3 col-md-12 col-sm-12 px-5 py-4 mx-4 mb-5 bg-danger rounded shadow">
                                <h6 class="text-center mb-1">Lantai ${item['lantai']}</h6>
                                <h4 class="text-center mb-1">${item['nama_meja']}</h4>
                                <h6 class="text-center mb-2">ada ${item['j_pesanan']} pesanan</h6>
                                <a href="/admin/home/${item['slug_meja']}" class="btn btn-meja">
                                    <h6 class="text-center text-white"><i class="fas fa-eye"></i> Pesanan</h6>
                                </a>
                            </div> 
                        `);

                    }
                })
            }
        })
    };

    $("#check-all").click(function(){
        if($(this).is(":checked"))
            $(".check-item").prop("checked", true);
        else
            $(".check-item").prop("checked", false);
    });

    $("#btn-view").click(function(){
        $("#form-view").submit();
    })

})
