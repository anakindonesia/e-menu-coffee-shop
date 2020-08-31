<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Pesanan-->
            <div class="user-data m-b-30">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-account-calendar"></i>Pesanan 
                </h3>

                <div class="table-responsive table-data px-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar Menu</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Pelanggan</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach($items as $item) : ?>
                                <tr>
                                    <td> 
                                        <?= $no++ ?>
                                    </td>
                                    <td >
                                        <img src="/uploads/<?= $item['gambar_menu'] ?>" class="image_upload">
                                    </td>
                                    <td>
                                        <span><?= $item['nama_menu'] ?></span>
                                    </td>
                                    <td>
                                        <span><?= $item['quantity'] ?></span>
                                    </td>
                                    <td>
                                        <span><?= $item['pelanggan'] ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary"><?= ($item['tmp_menu'] == '2') ? 'Selesai' : 'Sedang diproses'; ?></span>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="/admin/home/pesanan/proses/<?= $item['id_pesanan'] ?>" class="btn btn-success mr-1 <?= ($item['tmp_menu'] == '2') ? 'disabled' : ''; ?> "><i class="fas fa-check"></i> </a>
                                            <a href="/admin/home/pesanan/delete/<?= $item['id_pesanan'] ?>" class="btn btn-danger <?= ($item['tmp_menu'] == '2') ? 'disabled' : ''; ?> "><i class="fas fa-trash"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="user-data__footer">
                    <a href="/admin/home" class="au-btn au-btn-load">Home</a>
                </div>
            </div>
            <!-- END USER DATA-->
        </div>
    </div>

    </div>
</div>

<!-- akhir Modal Tampil Pesanan  -->

<?= $this->endsection() ?>
<!-- END MAIN CONTENT-->
           