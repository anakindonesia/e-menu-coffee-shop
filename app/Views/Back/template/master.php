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

    <!-- datepicker bootstrap  -->
    <link rel="stylesheet" href="/back/jquery-ui/jquery-ui.css">

    <!-- datatables  -->
    <link rel="stylesheet" href="/back/datatables/jquery.datatables.css">

    <!-- favicon  -->
    <link rel="shortcut icon" href="/favicon.png">

</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <!-- kalo bisa di ganti menjadi logo  -->
                            <h3>99's Coffee</h3>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="/admin/home">
                                <i class="fas fa-home"></i>Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="/admin/kategori">
                                <i class="fas fa-book"></i>Kategori
                            </a>
                        </li>
                        <li>
                            <a href="/admin/minuman">
                                <i class="fas fa-coffee"></i>Minuman
                            </a>
                        </li>
                        <li>
                            <a href="/admin/makanan">
                                <i class="fas fa-utensils"></i>Makanan
                            </a>
                        </li>
                        <li>
                            <a href="/admin/meja">
                                <i class="fas fa-table"></i>Kelola Meja
                            </a>
                        </li>
                        <li>
                            <a href="/admin/rekap">
                                <i class="fas fa-clipboard"></i>Rekap Penjualan
                            </a>
                        </li>
                        <li>
                            <a href="/admin/laporan/makanan">
                                <i class="fab fa-elementor"></i>Laporan Penjualan
                            </a>
                        </li> 
                        <li>
                            <?php if($_SESSION['level'] == 'admin'): ?>
                                <a href="/admin/user">
                                    <i class="fas fa-table"></i>Kelola User
                                </a>
                            <?php else: ?>

                            <?php endif ?>
                        </li> 
                        <li>
                            <a href="/admin/password">
                                <i class="fas fa-key"></i>Ganti Password
                            </a>
                        </li>
                    </ul>
                   
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <!-- kalo bisa di ganti menjadi logo  -->
                    <h3>99's Coffee</h3>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar" >
                    <?php 
                        $request = \Config\Services::request();
                        $url    = $request->uri->getSegment(2);
                    ?>
                    <ul class="list-unstyled navbar__list" id="nav">
                        
                        <li class="<?= ($url == 'home') ? 'active' : ''; ?>">
                            <a href="/admin/home">
                                <i class="fas fa-home"></i>Dashboard
                            </a>
                        </li>

                        <li class="<?= ($url == 'kategori') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin'): ?>
                                <a href="/admin/kategori">
                                    <i class="fas fa-book"></i>Kategori
                                </a>
                            <?php endif ?>
                        </li>

                        <li class="<?= ($url == 'minuman') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] =='koki'): ?>
                                <a href="/admin/minuman">
                                    <i class="fas fa-coffee"></i>Minuman
                                </a>
                            <?php endif ?>
                        </li>

                        <li class="<?= ($url == 'makanan') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] =='koki'): ?>
                                <a href="/admin/makanan">
                                    <i class="fas fa-utensils"></i>Makanan
                                </a>
                            <?php endif ?>
                        </li>

                        <li class="<?= ($url == 'meja') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin'): ?>
                                <a href="/admin/meja">
                                    <i class="fas fa-table"></i>Kelola Meja
                                </a>
                            <?php endif ?>
                        </li>

                        <li class="<?= ($url == 'rekap') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] =='kasir'): ?>
                                <a href="/admin/rekap">
                                    <i class="fas fa-clipboard"></i>Rekap Penjualan
                                </a>
                            <?php endif ?>
                        </li>

                        <li class="<?= ($url == 'laporan') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] =='kasir'): ?>
                                <a href="/admin/laporan/makanan">
                                    <i class="fab fa-elementor"></i>Laporan Penjualan
                                </a>
                            <?php endif ?>
                        </li>

                        <li class="<?= ($url == 'user') ? 'active' : ''; ?>">
                            <?php if($_SESSION['level'] == 'admin'): ?>
                                <a href="/admin/user">
                                    <i class="fas fa-users"></i>Kelola User
                                </a>                               
                            <?php endif ?>
                        </li> 

                        <li class="<?= ($url == 'password') ? 'active' : ''; ?>">
                            <a href="/admin/password">
                                <i class="fas fa-key"></i>Ganti Password
                            </a>
                        </li>

                    </ul>
                </nav>
               
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="float-left">
                                <h3>99's Coffee Tanjung Pura</h3>
                            </div>
                            <div class="header-button float-right"> 
                                <div>
                                    <h3><?= $_SESSION['nama'] ?></h3>
                                </div>
                                <div class="mx-3">
                                    <h3>|</h3>
                                </div>
                                <div>
                                    <button class="btn btn-secondary btn-keluar">
                                        <i class="fas fa-sign-out-alt"></i> Keluar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->


            <?= $this->renderSection('content'); ?>

             <!-- END PAGE CONTAINER-->
             <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2020 - 99's Coffee Tanjung Pura.Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    

<!-- Jquery JS-->
<script src="/back/vendor/jquery-3.2.1.min.js"></script>
<!-- pusher -->
<script src="/back/js/pusher.min.js"></script>
<script src="/back/js/my.js"></script>

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

<!-- datepicker bootstrap  -->
<script src="/back/jquery-ui/jquery-ui.js"></script>
<script src="/back/js/datepicker.js"></script>

<!-- datatables  -->
<script src="/back/datatables/jquery.datatables.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#table_id').DataTable();
})

</script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
       
    });
</script> -->

</body>

</html>
<!-- end document-->
