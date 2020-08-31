<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container">
            <div class="row">
            <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] =='koki'): ?>
                <!-- form pemesanan  -->
                <div class="col-6">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Pesanan Belum di Proses</h3>

                    <?php $session = \Config\Services::session(); ?>
                    <?php  if($session->getFlashdata('error')) : ?>
                        <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
                    <?php endif ?>

                    <div class="table-responsive m-b-40">

                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Meja</th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php foreach($pesanans as $key => $pesanan) : ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td>
                                                <?= $pesanan['pelanggan'] ?>
                                            </td>
                                            <td><?= $nama_meja ?></td>
                                            <td>
                                                <a href="/admin/home/lihat/<?= $pesanan['id_order'] ?>" type="button"  class="au-btn au-btn-icon btn-warning au-btn--small" >
                                                    <i class="fas fa-eye"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table> 

                    </div>
                    <!-- END DATA TABLE -->
                </div>

                <!-- form pesanan diproses -->
                <div class="col-6">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Pesanan Sedang di Proses</h3>

                    <?php $session = \Config\Services::session(); ?>
                    <?php  if($session->getFlashdata('error')) : ?>
                        <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
                    <?php endif ?>

                    <div class="table-responsive m-b-40">

                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Meja</th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php foreach($prosess as $key => $proses) : ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td>
                                                <?= $proses['pelanggan'] ?>
                                            </td>
                                            <td><?= $nama_meja ?></td>
                                            <td>
                                                <a href="/admin/home/pesanan/<?= $proses['id_order'] ?>" type="button"  class="au-btn au-btn-icon btn-warning au-btn--small" >
                                                    <i class="fas fa-eye"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table> 

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            <?php endif ?>

            <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] =='kasir'): ?>
                <!-- form pembayaran  -->
                <div class="col-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Pesanan Belum di Bayar</h3>

                    <?php $session = \Config\Services::session(); ?>
                    <?php  if($session->getFlashdata('error')) : ?>
                        <p class="alert alert-warning"><?= $session->getFlashdata('error'); ?></p>
                    <?php endif ?>

                    <div class="table-responsive m-b-40">
                        <form action="/admin/home/form/bayar" method="post" id="form-view">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th> <input type="checkbox" name="check" id="check-all"> </th>
                                        <th>Nama Pelanggan</th>
                                        <th>Meja</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php foreach($pembayarans as $key => $pembayaran) : ?>
                                        <tr>
                                            <td> <input type="checkbox" class="check-item" name="id[]" value="<?= $pembayaran['id_order'] ?>"> </td>
                                            <td><?= $pembayaran['pelanggan'] ?></td>
                                            <td><?= $nama_meja ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table> 
                            <br>
                            <div class="table-data__tool">
                        
                                <div class="table-data__tool-left">
                                    <input type="hidden" name="slug_meja" value="<?= $slug_meja ?>">
                                </div>

                                <div class="table-data__tool-right">
                                    <button type="button" id="btn-view" class="au-btn au-btn-icon au-btn--green au-btn--small" >
                                        <i class="fas fa-eye"> Lihat yang ditandai</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- END MAIN CONTENT-->
<?= $this->endsection() ?>

