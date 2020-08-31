<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php $validationErrors = $this->config->plugins['validation_errors'] ?>
<div class="main-content">
    <div class="col-lg-12">
    <?= form_open_multipart(base_url().'/admin/user/saveTambahUser'); ?>
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <strong>Tambah User</strong> 99's Coffee
                <a href="/admin/user" class="close">
                    <span>&times;</span>
                </a>
            </div>
            <div class="card-body card-block">

            <?php $session = \Config\Services::session(); ?>
            <?php  if($session->getFlashdata('error')) : ?>
                <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
            <?php endif ?>

                <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama" class=" form-control-label">Nama</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama User" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" value="<?= old('nama') ?>" maxlength="35">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="username" class=" form-control-label">Username</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="username" name="username" placeholder="Masukkan Username User" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" maxlength="20">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email" class=" form-control-label">E-Mail</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="email" name="email" placeholder="Masukkan Email User" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" maxlength="50">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password" class=" form-control-label">Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="password" name="password" placeholder="Masukkan Password User" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" maxlength="50">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password2" class=" form-control-label">Konfirmasi Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="password" id="password2" name="password2" placeholder="Masukkan Password User" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ?>" maxlength="50">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password2') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Level User</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="level" id="select" class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : '' ?>" value="<?= old('level') ?>">
                                <option value="">Please select</option>
                                <option value="admin">Admin</option>
                                <option value="koki">Koki</option>
                                <option value="kasir">Kasir</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('level') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endsection() ?>

