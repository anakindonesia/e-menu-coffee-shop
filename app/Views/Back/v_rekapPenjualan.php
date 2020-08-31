<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center mb-5">Rekap Penjualan</h1>
                <div class="table-responsive m-b-30">
                    <table id="table_id" class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengunjung</th>
                                <th>Meja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $key => $item) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $item['pelanggan'] ?></td>
                                    <td><?= $item['nama_meja'] ?></td>
                                    <td>
                                        <a href="/admin/rekap/<?= $item['id_order'] ?>" class="btn btn-warning">lihat</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>

<!-- akhir Modal Tampil Pesanan  -->

<?= $this->endsection() ?>
<!-- END MAIN CONTENT-->
           