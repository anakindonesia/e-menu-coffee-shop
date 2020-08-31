<?= $this->extend('Login/v_master') ?>

<?= $this->section('content') ?>

    <div class="page-wrapper">
        <div class="">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/admin">
                                <img src="/back/images/logo.png" alt="99's Coffee" class="img-login"> <br>
                                <h6>99's Coffee Tanjung Pura - Coffee Shop to Milenial</h6>
                            </a>
                        </div>
 
                        <div class="login-form">
                            
                            <?php $session = \Config\Services::session(); ?>
                            <?php  if($session->getFlashdata('error')) : ?>
                                <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
                            <?php endif ?>

                            <?= form_open('/login') ?>
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="meja">Pilih Meja</label>

                                    <select name="slug_meja" id="meja" class="form-control">
                                        <option value="">Silahkan Pilih Meja Anda</option>
                                        <?php foreach($mejas as $key => $meja) : ?>
                                            <option value="<?= $meja['slug_meja'] ?>"><?= $meja['nama_meja'] ?></option>
                                        <?php endforeach ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label  for="nama">Nama Anda</label>
                                    <input class="au-input au-input--full form-control" type="username" name="nama" id="nama" placeholder="Masukkan nama anda">
                                </div>
                                <div class="form-group">
                                    <label for="sandi">Sandi Meja</label>
                                    <input class="au-input au-input--full form-control " type="text" name="sandi" id="sandi" placeholder="Sandi Meja silahkan lihat di Meja duduk Anda">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Masuk</button>
                                <button class="au-btn au-btn--block btn-secondary m-b-20" type="button" data-toggle="modal" data-target="#loginModal">Login Dengan Scan QR</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal login  -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login dengan QR Code</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="single2">Silahkan klik Scan QR Code untuk login</label> 
                <input type="text" id="single2"  class="form-control" disabled> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="openreader-single2" 
                data-qrr-target="#single2" 
                data-qrr-audio-feedback="true">Scan QR Code</button>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal login  -->

<?= $this->endsection() ?>

