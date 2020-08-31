<?= $this->extend('Front/template/master') ?>

<?= $this->section('content') ?>
    
<!-- Pesanan -->
<div id="pesanan" class="pesanan mb-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9 pr-5">
                <h5 class="pesanan-anda">Pesanan Anda</h5>
                <?php if ( !$pesanan ): ?>
                <div class="row justify-content-center">
                    <div class="card">
                        <h3 class="mt-5 mb-5">Belum ada pesanan.</h3>
                    </div>
                </div>
                <?php else: ?>
                <div class="list-pesanan">
                    <?php foreach ($pesanan as $data) : ?>
                        <div class="row">
                            <div class="card" style="width: 100%">
                            <div class="row no-gutters">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img src="/uploads/<?= $data['gambar_menu'] ?>" class="card-img">
                                    </div>
                                    <div class="col-lg-3 d-flex align-items-center">
                                        <div class="item">
                                            <h5 class="card-title"><?= $data['nama_menu'] ?></h5>
                                        <p class="card-text"><small class="text-muted">Rp. <?= number_format($data['harga_menu'], 0, 0, ','); ?></small></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                        <div class="qty">
                                            <span class="input-group-btn">
                                                <a href="<?= base_url('cart/kurang/'.$data['id_pesanan']); ?>" class="btn-qty">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                            </span>
                                            <input type="text" class="input-qty" value="<?= $data['quantity'] ?>" min="1" max="100" disabled>
                                            <span class="input-group-btn">
                                                <a href="<?= base_url('cart/tambah/'.$data['id_pesanan']); ?>" class="btn-qty">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                        <div class="subtotal">
                                            <span class="subtotal-item">Rp.<?= number_format($data['sub_total'], 0, 0, ','); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 d-flex align-items-center justify-content-end">
                                        <a href="<?= base_url('cart/hapus/'.$data['id_pesanan']); ?>" class="btn-delete" id="btn-delete"><i class="fas fa-lg fa-times"></i></a>
                                    </div>
                                </div>
                                <hr style="margin-top: 15px;">
                            </div>
                            </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>


            <div class="col-lg-3  mb-3">
                <div class="card shadow bg-dark text-white info-bayar" style="width: 100%; padding-left: 10px; padding-right: 10px;">
                <div class="row">
                    <h5 class="info-bayar-title">Informasi Pembayaran</h5>
                </div>
                <hr>
                <?php if ( !$pesanan ): ?>
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        <div class="item mb-2">
                            <p>Belum ada pesanan.</p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <?php foreach ($pesanan as $detail): ?>
                <div class="row">
                    <div class="col d-flex align-items-center">
                        <div class="item">
                            <h6><?= $detail['nama_menu']; ?></h6>
                            <p style="margin-top: -8px;"><?= $detail['quantity']; ?></p>
                        </div>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <p>Rp. <?= number_format($detail['sub_total'], 0, 0, ','); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>

                <hr style="background-color: rgba(255,255,255,0.4);">
                <div class="row" style="font-weight: 600;">
                    <div class="col-4">
                        <div class="item">
                            <h6 style="font-weight: 600;">Total</h6>
                        </div>
                    </div>
                    <div class="col text-right">

                        <?php if ( !$pesanan ): ?>
                        <p style="font-size: 1rem;">-</p>
                        <?php else: ?>
                        <p style="font-size: 0.9rem;">Rp. <?= number_format($total_bayar, 0, 0, ','); ?></p>
                        <?php endif; ?>

                    </div>
                </div>
                <?php if ( !$pesanan ): ?>
                <?php else: ?>
                <div class="row">
                    <div class="col mb-3 mt-1">
                        <a href="<?= base_url('cart/proses/'.$data['id_order']); ?>" id="bayar" class="btn btn-pesan text-uppercase" style="width: 100%;">Proses Pesanan</a>
                    </div>
                </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Pesanan -->

<!-- footer -->



<?= $this->endSection() ?>