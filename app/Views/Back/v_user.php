<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5">Daftar User</h3>
                    <div class="table-data__tool">
                        
                        <div class="table-data__tool-left">

                        </div>

                        <div class="table-data__tool-right">
                            <a href="/admin/user/tambah" type="button" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add user
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>level</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($users as $key => $user) :?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $user['nama'] ?></td>
                                    <td><?= $user['level'] ?></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="/admin/user/edit/<?= $user['id_user'] ?>" class="item btn-edit" id="btn-edit" data-placement="top" title="Edit" >
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <button type="button" class="item btn-delete" data-toggle="modal" data-placement="top" title="Delete" data-target="#deleteModal<?= $user['id_user'] ?>">
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


<?php foreach($users as $key => $user) : ?>
<form action="/admin/user/delete" method="POST">
<?= csrf_field(); ?>
    <div class="modal fade" id="deleteModal<?= $user['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah Anda yakin akan menghapus user <?= $user['nama'] ?></h4>
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
<?php endforeach ?>

<!-- END MAIN CONTENT-->
<?= $this->endsection() ?>
