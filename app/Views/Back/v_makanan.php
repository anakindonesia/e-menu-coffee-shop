<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Daftar Makanan</h3>
                    <div class="table-data__tool">
                        
                        <div class="table-data__tool-left">

                        </div>

                        <div class="table-data__tool-right">
                            <?php if($_SESSION['level'] == 'admin'): ?>
                                <a href="/admin/makanan/tambah" type="button" class="au-btn au-btn-icon au-btn--green au-btn--small" >
                                    <i class="zmdi zmdi-plus"></i>add item
                                </a>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="table-responsive m-b-40">
                        <table id="table_id" class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Makanan</th>
                                    <th>Gambar Makanan</th>
                                    <th>Harga Makanan</th>
                                    <th>Kategori</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($makanans as $key => $makanan) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $makanan['nama_menu'] ?></td>
                                    <td>
                                        <img src="/uploads/<?= $makanan['gambar_menu'] ?>" class="image_upload">
                                    </td>
                                    <td>Rp. <?= number_format($makanan['harga_menu'], 0, ',' ,'.'); ?></td>
                                    <td><?= $makanan['kategori'] ?></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <?php if($_SESSION['level'] == 'admin'): ?>
                                                <a href="/admin/makanan/edit/<?= $makanan['id_menu'] ?>" type="button" class="item btn-edit" id="btn-edit"  data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                            <?php endif ?>

                                            <?php if ($makanan['is_active'] == 1) : ?>
                                                <a href="/admin/makanan/status/<?= $makanan['id_menu'] ?>/<?= $makanan['is_active'] ?>" type="button" class="item btn-edit" id="btn-edit"  data-toggle="tooltip" data-placement="top" title="matikan menu">
                                                    <i class="fas fa-power-off"></i> 
                                                </a> 
                                            <?php else : ?>
                                                <a href="/admin/makanan/status/<?= $makanan['id_menu'] ?>/<?= $makanan['is_active'] ?>" type="button" class="item btn-edit" id="btn-edit"  data-toggle="tooltip" data-placement="top" title="aktifkan menu">
                                                    <i class="fas fa-check"></i> 
                                                </a> 
                                            <?php endif ?>

                                            <?php if($_SESSION['level'] == 'admin'): ?>
                                                <button type="button" class="item btn-delete" data-toggle="modal" data-placement="top" title="Delete" data-target="#deleteModal<?= $makanan['id_menu'] ?>">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            <?php endif ?>
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


<!-- Modal Hapus Makanan  -->
<?php foreach($makanans as $key => $makanan) : ?>
<form action="/admin/makanan/hapusMakanan" method="POST">
<?= csrf_field(); ?>
    <div class="modal fade" id="deleteModal<?= $makanan['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Makanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah Anda yakin akan menghapus <?= $makanan['nama_menu'] ?></h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_makanan" value="<?= $makanan['id_menu'] ?>">
                    <input type="hidden" name="gambar_makanan" value="<?= $makanan['gambar_menu'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach ?>

<!-- END MAIN CONTENT-->
<?= $this->endsection() ?>

