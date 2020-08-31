<?= $this->extend('Front/template/master') ?>

<?= $this->section('content') ?>
    
<!-- Pesanan -->
<div id="pesanan" class="pesanan mb-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-3 col-md-12">

            </div>
            <div class="col-lg-6 col-md-12  mb-3">

                <?php $session = \Config\Services::session(); ?>
                <?php  if($session->getFlashdata('error')) : ?>
                    <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
                <?php endif ?>
                
                <div class="card shadow bg-dark text-white info-bayar" style="width: 100%; padding-left: 10px; padding-right: 10px;">
                <div class="row">
                    <h5 class="info-bayar-title">Informasi Pembayaran</h5>
                </div>
                <hr>
                   
                <div id="daftar_menu">
                    <!-- file dari json  -->
                </div>

                <hr style="background-color: rgba(255,255,255,0.4);">
                <div id="total">
                    <!-- file total dari json  -->
                </div>
                
                <div class="row">
                    <div class="col mb-3 mt-1" id="tombol">
                        <!-- tombol dari json -->
                    </div>
                </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-12">

            </div>
        </div>
    </div>
</div>
<!-- End Pesanan -->



<?= $this->endSection() ?>