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
                            <?php  if($session->getFlashdata('sukses')) : ?>
                                <p class="alert alert-success"><?= $session->getFlashdata('sukses'); ?></p>
                            <?php endif ?>
                            <?php  if($session->getFlashdata('error')) : ?>
                                <p class="alert alert-danger"><?= $session->getFlashdata('error'); ?></p>
                            <?php endif ?>
                            
                            <?= form_open(base_url('admin/reset/save')) ?>
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label>Masukkan Password</label>
                                    <input class="au-input au-input--full form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" type="password" name="password" placeholder="Masukkan Password" autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input class="au-input au-input--full form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ?>" type="password" name="password2" placeholder="Ulangi password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password2') ?>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?= $token ?>">
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Reset</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?= $this->endsection() ?>