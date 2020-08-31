<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php 
    $request = \Config\Services::request();
    $url    = $request->uri->getSegment(3);
?>
<div class="main-content">
    <div class="row">
    <div class="col-lg-2 col-md-12"></div>
    <div class="col-lg-8 col-md-12">
    <form action="/admin/laporan/cetak" method="POST" target="_blank"></form>
    <?= form_open_multipart(base_url().'/admin/laporan/'.$url.'/cetak'); ?>
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <strong>Laporan Penjualan</strong> 99's Coffee <br>
                <div class="mt-3 ">
                    <ul class="nav nav-tabs" id="nav">
                        <li class="nav-item">
                            <a href="/admin/laporan/menu" class="nav-link text-secondary <?= ($url == 'menu') ? 'active' : 'font-weight-bold'; ?>">Penjualan Minuman dan Makanan</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/laporan/meja" class="nav-link text-secondary <?= ($url == 'meja') ? 'active' : 'font-weight-bold'; ?>">Penjualan Permeja</a>
                        </li>
                    </ul>
                </div>
            </div>
                                
                <div class="card-body card-block">
                    <label for="awal" >Dari tanggal : </label>
                    <input type="text" id="awal" name="awal" class="form-control datepicker" placeholder="semua laporan">
                    
                    <label for="akhir" >Sampai tanggal : </label>
                    <input type="text" id="akhir" name="akhir" class="form-control datepicker" placeholder="semua laporan">

                    <?php if($url !== 'meja') : ?>
                        <label for="kategori">Pilih Kategori</label>
                        <select id="kategori" name="kategori" class="form-control">
                            <option value="">Semua Kategori</option>
                            <?php foreach($kategoris as $kategori) : ?>
                                <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['kategori'] ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php endif ?>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-danger btn-sm float-right">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </button>
                </div>
        </div>
        <?= form_close() ?>
    </div>
    <div class="col-lg-2 col-md-12"></div>
    </div>
</div>
<?= $this->endsection() ?>

