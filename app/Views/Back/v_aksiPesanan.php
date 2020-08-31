<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="container">
    <div class="row">
        <div class="col-8">
            <!-- Pesanan-->
            <div class="user-data m-b-30">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-account-calendar"></i>Pesanan
                </h3>

                <div class="table-responsive px-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar Menu</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Pelanggan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach($items as $key) : ?>
                                <?php foreach($key as $item) : ?>
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
                                            <span><?= $item['status_menu'] == 0 ? 'Utama' : 'Tambahan' ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END USER DATA-->
        </div>
        <div class="col-4">
            <!-- TOP CAMPAIGN-->
            <div class="top-campaign">
                <h3 class="title-3 m-b-30">Pembayaran</h3>
                <div class="table-responsive">
                    <table class="table table-top-campaign">
                        <tr>
                            <td>Menu</td>
                            <td class="text-center">Qty</td>
                            <td class="text-secondary">Harga</td>
                        </tr>
                        <?php $total = 0 ?>
                        <?php foreach($items as $key) : ?>
                            <?php foreach($key as $item) : ?>
                                <tr>
                                    <td><?= $item['nama_menu'] ?></td>
                                    <td class="text-center"><?= $item['quantity'] ?></td>
                                    <td class="text-secondary">Rp. <?= number_format($item['sub_total'], 0, 0, '.') ?></td>
                                </tr>
                                <?php $total += $item['sub_total']?>
                            <?php endforeach ?>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="2" class="font-weight-bold">TOTAL</td>
                            <td class="font-weight-bold">Rp. <?=  number_format($total , 0, 0, '.') ?></td>
                        </tr>
                    </table>
                </div>
                <div class="user-data__footer">
                    <form action="/admin/home/aksi/bayar" method="post">

                        <?php foreach($items as $key) : ?>
                            <?php foreach($key as $item) : ?>
                                <input type="hidden" name="id[]" value="<?= $item['id_order'] ?>">
                            <?php endforeach ?>
                        <?php endforeach ?>

                        <button type="submit" class="au-btn au-btn-load btn-danger btn-bayar">Bayar</button>
                   
                    </form>
                </div>
            </div>
            <!--  END TOP CAMPAIGN-->
        </div>
    </div>
    </div>
</div>

<!-- akhir Modal Tampil Pesanan  -->

<?= $this->endsection() ?>
<!-- END MAIN CONTENT-->
           