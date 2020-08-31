<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php $validationErrors = $this->config->plugins['validation_errors'] ?>
<div class="main-content">
    <div class="col-lg-12">
 
    <?= form_open_multipart(base_url().'/admin/makanan/saveEdit'); ?>
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <strong>Edit Makanan</strong> 99's Coffee
                <a href="/admin/makanan" class="close">
                    <span>&times;</span>
                </a>
            </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nama_makanan" class=" form-control-label">Nama Makanan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nama_makanan" name="nama_makanan" placeholder="Masukkan Nama Minuman" class="form-control <?= ($validation->hasError('nama_makanan')) ? 'is-invalid' : '' ?>" value="<?= $makanan['nama_menu'] ?>" maxlength="30" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_makanan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="harga_makanan" class=" form-control-label">Harga Makanan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="harga_makanan" name="harga_makanan" placeholder="Masukkan harga Minuman" class="form-control <?= ($validation->hasError('harga_makanan')) ? 'is-invalid' : '' ?>" value="<?= $makanan['harga_menu'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga_makanan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="kategori" class=" form-control-label">Kategori</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="kategori" id="kategori" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ?>">
                                <?php foreach($kategoris as $key => $kategori) : ?>
                                    <option value="<?= $kategori['id_kategori'] ?>" <?= ($kategori['kategori'] == $makanan['kategori'] ) ? 'selected' : '' ?>>
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
                            <input type="hidden" name="gambar_makanan" id="gambar_makanan" value="<?= $makanan['gambar_menu'] ?>"> <br>
                            <input type="hidden" name="id_makanan" id="id_makanan" value="<?= $makanan['id_menu'] ?>"> <br>
                            <img src="/uploads/<?= $makanan['gambar_menu'] ?>" class="d-block image_edit_upload">
                        </div>
                    </div>
                    
                    <div class="row form-group">
                       
                        <div class="col col-md-3">
                            <label for="upload_gambar" class=" form-control-label ">Upload Gambar</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="upload_gambar" name="upload_gambar" class="form-control-file " value="<?= $makanan['gambar_menu'] ?>">
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
                    <a href="/admin/makanan" class="btn btn-danger btn-sm float-right">
                        <i class="fa fa-ban"></i> Cancel
                    </a>
                </div>
            
        </div>
    <?= form_close() ?>
    </div>
</div>
<?= $this->endsection() ?>

