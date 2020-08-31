<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Daftar Kategori</h3>
                    <div class="table-data__tool">
                        
                        <div class="table-data__tool-left">

                        </div>

                        <div class="table-data__tool-right">
                            <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#addModal">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive m-b-40">
                        <table id="table_id" class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Jenis Kategori</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($items as $key => $item) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $item['kategori'] ?></td>
                                    <td><?= $item['jenis_kategori'] ?></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button type="button" class="item btn-edit" id="btn-edit" data-toggle="modal" data-placement="top" title="Edit" data-target="#editModal<?= $item['id_kategori'] ?>" >
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button type="button" class="item btn-delete" data-toggle="modal" data-placement="top" title="Delete" data-target="#deleteModal<?= $item['id_kategori'] ?>">
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

<!-- Modal Tambah Kategori  -->
<form action="/admin/kategori/save" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="kategori" class=" form-control-label">Kategori</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="kategori" name="kategori" placeholder="Masukkan Nama Kategori" class="form-control" maxlength="30" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Jenis Kategori</label>
                        </div>
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="radio">
                                    <label for="jenis1" class="form-check-label ">
                                        <input type="radio" id="jenis1" name="jenis_kategori" value="Minuman" class="form-check-input">Minuman
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="jenis2" class="form-check-label ">
                                        <input type="radio" id="jenis2" name="jenis_kategori" value="Makanan" class="form-check-input">Makanan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return radioValidation()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- akhir Modal Tambah Kategori  -->

<!-- Modal Edit Kategori  -->
<?php foreach($items as $key => $item) : ?>
<form action="/admin/kategori/update" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="editModal<?= $item['id_kategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="kategori" class=" form-control-label">Kategori</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="kategori" name="kategori" placeholder="Masukkan Nama Kategori" class="form-control kategori" value="<?= $item['kategori'] ?>" maxlength="30" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label class=" form-control-label">Jenis Kategori</label>
                        </div>
                        <div class="col col-md-9">
                            <div class="form-check">
                                <div class="radio">
                                    <label for="jenis1" class="form-check-label ">
                                        <input type="radio" id="jenis1" name="jenis_kategori" value="Minuman" class="form-check-input" <?php if($item['jenis_kategori']=='Minuman') echo 'checked' ?>>Minuman
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="jenis2" class="form-check-label ">
                                        <input type="radio" id="jenis2" name="jenis_kategori" value="Makanan" class="form-check-input" <?php if($item['jenis_kategori']=='Makanan') echo 'checked' ?>>Makanan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kategori" value="<?= $item['id_kategori'] ?>">
                    <button type="submit" class="btn btn-primary" onclick="return radioValidation()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach ?>
<!-- akhir Modal Edit Kategori  -->

<!-- Modal Hapus Kategori  -->
<?php foreach($items as $key => $item) : ?>
<form action="/admin/kategori/delete" method="POST">
<?= csrf_field(); ?>
    <div class="modal fade" id="deleteModal<?= $item['id_kategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah Anda yakin akan menghapus <?= $item['kategori'] ?></h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kategori" value="<?= $item['id_kategori'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach ?>

<!-- akhir Modal Hapus Kategori  -->

<script>
function radioValidation(){
    var jenis_kategori  = document.getElementsByName("jenis_kategori");
    var genValue        = false;

    for(var i=0; i<jenis_kategori.length;i++){
        if(jenis_kategori[i].checked == true){
            genValue = true;
        }
    }
    if(!genValue){
        alert("silahkan pilih dahulu jenis kategori : makanan atau minuman ");
        return false;
    }
}
</script>

<!-- END MAIN CONTENT-->
<?= $this->endsection() ?>

