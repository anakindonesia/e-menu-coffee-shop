<!doctype html>
<html lang="en">

    <head>

		<!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>99's Coffee</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
		<link rel="stylesheet" href="/front/assets/css/bootstrap.min.css">
        <link href="/front/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="/front/assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="/front/assets/css/style.css">
		<link rel="shortcut icon" href="/favicon.png">

		<!-- sweet alert  -->
		<link href="/sweetalert/dist/sweetalert2.min.css" rel="stylesheet" media="all">

    </head>

    <body>

		<!-- Wrapper -->
    	<div class="wrapper">

			<!-- Sidebar -->
			<nav class="sidebar">
				
				<!-- close sidebar menu -->
				<div class="dismiss">
					<i class="fas fa-arrow-left"></i>
				</div>
				
				<div class="logo">
					<img src="/front/assets/img/logo.png" alt="">
				</div>
				
				<?php 
					$request = \Config\Services::request();
					$url    = $request->uri->getSegment(2);
				?>

				<ul class="list-unstyled menu-elements">
					<p>MINUMAN</p> <hr>
					<?php foreach ($minumans as $key => $minuman) :?>
						<li class="<?= ($url == $minuman['id_kategori']) ? 'active' : ''; ?>">
							<a href="/menu/<?= $minuman['id_kategori'] ?>"><i class="fas fa-coffee"></i><?= $minuman['kategori'] ?></a>
						</li>
					<?php endforeach ?>

					<p>MAKANAN</p> <hr>
					<?php foreach ($makanans as $key => $makanan) :?>
						<li class="<?= ($url == $makanan['id_kategori']) ? 'active' : ''; ?>">
							<a href="/menu/<?= $makanan['id_kategori'] ?>"><i class="fas fa-utensils"></i><?= $makanan['kategori'] ?></a>
						</li>
					<?php endforeach ?>
				</ul>
				
				<div class="to-top mb-5">
					<a class="btn btn-primary btn-customized-3 mb-5" href="#" role="button">
	                    <i class="fas fa-arrow-up"></i> Top
	                </a>
				</div>
							
			</nav>
			<!-- End sidebar -->
			
			<!-- Dark overlay -->
			<div class="overlay"></div>
			<div class="content">
				<div class="logo mb-3 pt-3">
					<h1 ><a href="index.html"><b>9<br>9<br>s</b>Coffee Shop<p>Tempat Nongkrong Zaman Now</p></a></h1>
					<h5 class="d-block text-white pb-1"><?= $nama ?> | <?= $meja ?></h5>
				</div>	
				<!-- Content -->
				<?= $this->renderSection('content'); ?>
				<!--end-Content -->

				<?php 
					$request = \Config\Services::request();
					$url    = $request->uri->getSegment(1);
				?>
				<div class="btn-group btn-group-lg fixed-bottom">
					<a href="/home" class="btn btn-customized-4 rounded-0 <?= ($url == 'home') ? 'active' : ''; ?>">
						<i class="fas fa-home"></i> <span> Home</span>
					</a>
					<a href="/cart" class="btn btn-customized-4 rounded-0 <?= ($url == 'cart') ? 'active' : ''; ?>">
						<i class="fas fa-clipboard"></i> <span> Keranjang</span>
					</a>
					<a href="" class="btn btn-customized-4 rounded-0 open-menu <?= ($url == 'menu') ? 'active' : ''; ?>">
						<i class="fab fa-elementor"></i> <span> Menu</span>
					</a>
				</div>
			</div>
    	</div>
        <!-- End wrapper -->

        <!-- Javascript -->
		<script src="/front/assets/js/jquery-3.3.1.min.js"></script>
		<script src="/front/assets/js/popper.min.js"></script>
		<script src="/front/assets/js/bootstrap.min.js"></script>
        <script src="/front/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="/front/assets/js/scripts.js"></script>
		<script src="/front/assets/js/my.js"></script>
		<script src="/front/assets/js/pusher.min.js"></script>
		
		<!-- sweet alert -->
		<script src="/sweetalert/dist/sweetalert2.min.js"></script>
		<script src="/front/assets/js/my-alert.js"></script>

    </body>

</html>