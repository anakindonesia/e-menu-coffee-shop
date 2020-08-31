<?= $this->extend('Login/v_master') ?>

<?= $this->section('content') ?>

    <div class="page-wrapper">
        <div class="page-content--bge5">
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

                            <?= form_open(base_url('login')) ?>
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label  for="nama">Nama Anda</label>
                                    <input class="au-input au-input--full form-control" type="username" name="nama" id="nama" placeholder="Masukkan nama anda">
                                    <input class="au-input au-input--full form-control " type="hidden" name="slug_meja" id="meja" value="<?= $slug ?>">
                                    <input class="au-input au-input--full form-control " type="hidden" name="sandi" id="sandi" value="<?= $sandi ?>">
                                </div>
                                    
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Masuk</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endsection() ?>