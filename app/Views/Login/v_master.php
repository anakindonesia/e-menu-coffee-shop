<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>99's Coffee</title>

    <!-- Fontfaces CSS-->
    <link href="/back/css/font-face.css" rel="stylesheet" media="all">
    <link href="/back/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/back/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/back/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="/back/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="/back/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/back/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <!-- <link href="/back/vendor/wow/animate.css" rel="stylesheet" media="all"> -->
    <link href="/back/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/back/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/back/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/back/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/back/css/theme.css" rel="stylesheet" media="all">

    <!-- sweet alert  -->
    <link href="/sweetalert/dist/sweetalert2.min.css" rel="stylesheet" media="all">

    <!-- qrcode reader  -->
    <link rel="stylesheet" href="/back/qrcode-reader/css/qrcode-reader.css">

</head>

<body>


    <?= $this->renderSection('content'); ?>


<!-- Jquery JS-->
<script src="/back/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="/back/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/back/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="/back/vendor/slick/slick.min.js">
</script>
<script src="/back/vendor/wow/wow.min.js"></script>
<script src="/back/vendor/animsition/animsition.min.js"></script>
<script src="/back/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="/back/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="/back/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="/back/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/back/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/back/vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="/back/js/main.js"></script>

<!-- sweet alert -->
<script src="/sweetalert/dist/sweetalert2.min.js"></script>
<script src="/back/js/my-alert.js"></script>

<!-- qrcode reader  -->
<script src="/back/qrcode-reader/js/qrcode-reader.min.js?v=20190604"></script>

<script>
  
  $(function(){

    // overriding path of JS script and audio 
    $.qrCodeReader.jsQRpath = "/back/qrcode-reader/js/jsQR/jsQR.min.js";
    $.qrCodeReader.beepPath = "/back/qrcode-reader/audio/beep.mp3";

    // bind all elements of a given class
    $(".qrcode-reader").qrCodeReader();

    // bind elements by ID with specific options
    $("#openreader-multi2").qrCodeReader({multiple: true, target: "#multiple2", skipDuplicates: false});
    $("#openreader-multi3").qrCodeReader({multiple: true, target: "#multiple3"});

    // read or follow qrcode depending on the content of the target input
    $("#openreader-single2").qrCodeReader({callback: function(code) {
      if (code) {
        window.location.href = code;
      }  
    }}).off("click.qrCodeReader").on("click", function(){
      var qrcode = $("#single2").val().trim();
      if (qrcode) {
        window.location.href = qrcode;
      } else {
        $.qrCodeReader.instance.open.call(this);
      }
    });


  });

</script>

</body>

</html>
<!-- end document-->