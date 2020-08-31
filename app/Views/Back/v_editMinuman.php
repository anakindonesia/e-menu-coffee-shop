<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php $validationErrors = $this->config->plugins['validation_errors'] ?>
<div class="main-content">
    <div class="col-lg-12">
    <?= form_open_multipart(base_url().'/admin/minuman/saveEdit'); ?>
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <strong>Edit Minuman</strong> 99's Coffee
                <a href="/admin/minuman" class="close">
                    <span>&times;</span>
                </a>
            </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="namaMinuman" class=" form-control-label">Nama Minuman</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="namaMinuman" name="nama_minuman" placeholder="Masukkan Nama Minuman" class="form-control <?= ($validation->hasError('nama_minuman')) ? 'is-invalid' : '' ?>" value="<?= $minuman['nama_menu'] ?>" maxlength="30" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_minuman') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="hargaMinuman" class=" form-control-label">Harga Minuman</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="hargaMinuman" name="harga_minuman" placeholder="Masukkan harga Minuman" class="form-control <?= ($validation->hasError('harga_minuman')) ? 'is-invalid' : '' ?>" value="<?= $minuman['harga_menu'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga_minuman') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Kategori</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="kategori" id="select" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ?>">
                                <?php foreach($kategoris as $key => $kategori) : ?>
                                    <option value="<?= $kategori['id_kategori'] ?>" <?= ($kategori['kategori'] == $minuman['kategori'] ) ? 'selected' : '' ?>>
                                        <?= $kategori['kategori'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('kategori') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"> </div>
                        <div class="col-12 col-md-9">
                            <input type="hidden" name="gambar_minuman" value="<?= $minuman['gambar_menu'] ?>"> <br>
                            <input type="hidden" name="id_minuman" value="<?= $minuman['id_menu'] ?>"> <br>
                            <img src="/uploads/<?= $minuman['gambar_menu'] ?>" class="d-block image_edit_upload">
                        </div>
                    </div>
                    
                    <div class="row form-group">
                       
                        <div class="col col-md-3">
                            <label for="gambar" class=" form-control-label ">Upload Gambar</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="gambar" name="upload_gambar" class="form-control-file " value="<?= $minuman['gambar_menu'] ?>">
                           <h1></h1> 
                           <small>file yang di upload harus berekstensi jpg, jpeg, atau png</small> <br>
                          <small class="text-danger"><?=  $validationErrors(['field'=>'upload_gambar']) ?></small>    
                        </div>
                    </div>
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm float-right">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            
        </div>
        <?= form_close() ?>
    </div>
</div>
<?= $this->endsection() ?>

