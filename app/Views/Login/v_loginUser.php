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
                            <?php if(isset($error)){ echo '<p class="alert alert-warning">'.$error.'</p>'; } ?>
                            
                            <?= form_open(base_url('admin/login')) ?>
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full form-control" type="username" name="username" placeholder="Username anda" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full form-control " type="password" name="password" placeholder="Password Anda">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Masuk</button>
                                <div class="text-center">
                                    Lupa Password ? <button type="button" class="text-primary" data-toggle="modal" data-target="#resetModal">klik disini</button>
                                </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Reset password -->
    <form action="/admin/reset" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <label for="email" class=" form-control-label">Masukkan E-mail Anda</label>
                            </div>
                            <div class="col-12 col-md-12">
                                <input type="text" id="email" name="email" placeholder="Email anda" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- akhir Modal reset password  -->
<?= $this->endsection() ?>


