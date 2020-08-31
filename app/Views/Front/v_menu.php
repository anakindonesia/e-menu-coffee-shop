<?= $this->extend('Front/template/master') ?>

<?= $this->section('content') ?>
	
<div class="container">

	<?php $session = \Config\Services::session(); ?>
	<?php  if($session->getFlashdata('success')) : ?>
		<p class="alert alert-info"><?= $session->getFlashdata('success'); ?></p>
	<?php endif ?>
	
	<?php if(!empty($items)): ?>
		<div class="row p-5">
			<?php foreach($items as $item) : ?>
			<div class="col-md-4 mb-4">
				<div class="card" >
					<img class="img-thumbnail img-responsive rounded" src="/uploads/<?= $item['gambar_menu']; ?>" alt="99 Coffee menu images" style="height: 200px;">
					<div class="card-body">
						<h5 class="card-title"><?= character_limiter($item['nama_menu'], 20) ?></h5>
						<p class="card-text">Rp. <?= number_format( $item['harga_menu'], 0, ',' ,'.'); ?> </p>
						<?php if($item['is_active'] == 1) : ?>
							<a href="<?= base_url('cart/beli/'.$item['id_menu']); ?>" class="btn btn-block btn-customized-2">Beli</a>
						<?php else : ?>
							<a class="btn btn-block btn-secondary disabled">Menu Habis</a>
						<?php endif ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="p-5">
			<h3 class="text-center">Mohon maaf menu dikategori <span class="font-weight-bold"><?= $kategori ?></span> tidak tersedia, Silahkan pilih kategori lainnya</h3>
		</div>
	<?php endif ?>
</div>
<!-- end navbar content -->

<!-- footer -->

<?= $this->endSection() ?>