<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php $validationErrors = $this->config->plugins['validation_errors'] ?>
<div class="main-content">
    <div class="col-lg-12">
    <form action="/admin/password/reset" method="post" class="reset-password-alert" >
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <strong>Ganti Password</strong> user
            </div>
            <div class="card-body card-block">

            <?php $session = \Config\Services::session(); ?>
            <?php  if($session->getFlashdata('error')) : ?>
                <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
            <?php endif ?>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="password_lama" class=" form-control-label">Password Lama</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="password" name="password_lama" placeholder="Masukkan password lama" class="form-control <?= ($validation->hasError('password_baru')) ? 'is-invalid' : '' ?>" maxlength="50">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password_lama') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="password_baru" class=" form-control-label">Password Baru</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="password" name="password_baru" placeholder="Masukkan password baru" class="form-control <?= ($validation->hasError('password_baru')) ? 'is-invalid' : '' ?>" maxlength="50">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password_baru') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="password_baru2" class=" form-control-label">Konfirmasi Password</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="password" name="password_baru2" placeholder="Masukkan konfirmasi password baru" class="form-control <?= ($validation->hasError('password_baru2')) ? 'is-invalid' : '' ?>" maxlength="50">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password_baru2') ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer ">
                    <input type="hidden" name="id_user" value="<?= $_SESSION['user_id'] ?>">
                    <button type="button" class="btn btn-primary float-right btn-reset-alert">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

<?= $this->endsection() ?>

