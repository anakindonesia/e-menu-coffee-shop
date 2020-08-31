<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php $validationErrors = $this->config->plugins['validation_errors'] ?>
<div class="main-content">
    <div class="col-lg-12">
    <?= form_open_multipart(base_url().'/admin/user/saveEditUser'); ?>
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
                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama User" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" value="<?= $user['nama'] ?>" maxlength="35">
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
                            <input type="text" id="username" name="username" placeholder="Masukkan Username User" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" value="<?= $user['username'] ?>" maxlength="20">
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
                            <input type="text" id="email" name="email" placeholder="Masukkan E-Mail User" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" value="<?= $user['email'] ?>" maxlength="50">
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
                            <input type="password" id="password" name="password" placeholder="Masukkan Password User" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" value="<?= $user['password'] ?>" disabled>
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
                            <input type="password" id="password2" name="password2" placeholder="Masukkan Password User" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ?>" value="<?= $user['password'] ?>" disabled>
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
                            <select name="level" id="select" class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : '' ?>">
                                <?php foreach($levels as $key => $level) : ?>
                                    <option value="<?= $level ?>" <?= ($level == $user['level'] ) ? 'selected' : '' ?>>
                                        <?= $level?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('level') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>

                    <button  type="button" class="btn btn-danger float-right mr-1 text-white" data-toggle="modal" data-target="#resetModal<?= $user['id_user'] ?>">
                        <i class="fa fa-dot-circle-o"></i> Reset Password
                    </button>

                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<form action="/admin/user/reset/<?= $user['id_user'] ?>" method="POST">
<?= csrf_field(); ?>
    <div class="modal fade" id="resetModal<?= $user['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h4>Anda akan mereset password user <?= $user['nama'] ?></h4>
                    <h6>Password akan otomatis berubah menjadi 12345</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endsection() ?>

