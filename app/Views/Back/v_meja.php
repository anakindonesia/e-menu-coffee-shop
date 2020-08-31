<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Daftar Meja</h3>
                    <div class="table-data__tool">
                        
                        <div class="table-data__tool-left">

                        </div>

                        <div class="table-data__tool-right">
                            <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModal">
                                <i class="zmdi zmdi-plus"></i>Buat Meja
                            </button>
                            <a href="/admin/meja/cetak" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fas fa-print"></i>Cetak Meja
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive m-b-40">
                        <table id="table_id" class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>meja</th>
                                    <th>sandi</th>
                                    <th>lantai</th>
                                    <th>QR Code</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($items as $key => $item) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $item['nama_meja'] ?></td>
                                    <td><?= $item['sandi_meja'] ?></td>
                                    <td><?= $item['lantai'] ?></td>
                                    <td><img src="<?= base_url('QRCode/'.$item['qrcode'])?>" class="image_upload"></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button type="button" class="item btn-delete" data-toggle="modal" data-placement="top" title="Delete" data-target="#deleteModal<?= $item['id_meja'] ?>">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div> 
</div>

<!-- Modal Tambah Meja  -->
<form action="/admin/meja/save" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Jumlah Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="jumlah_meja" class=" form-control-label">Jumlah Meja</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="jumlah_meja" name="jumlah_meja" placeholder="Masukkan Jumlah Meja" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="lantai" class=" form-control-label">Pilih Lantai</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="lantai" id="lantai" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Kunci Sandi</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="kunci_sandi" name="kunci_sandi" placeholder="Masukkan kunci sandi" class="form-control" maxlength="10" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- akhir Modal Tambah meja  -->

<!-- Modal Hapus Kategori  -->
<?php foreach($items as $key => $item) : ?>
<form action="/admin/meja/delete" method="POST">
<?= csrf_field(); ?>
    <div class="modal fade" id="deleteModal<?= $item['id_meja'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah Anda yakin akan menghapus <?= $item['nama_meja'] ?></h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_meja" value="<?= $item['id_meja'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach ?>
<!-- akhir Modal Hapus Kategori  -->



<?= $this->endsection() ?>
<!-- END MAIN CONTENT-->