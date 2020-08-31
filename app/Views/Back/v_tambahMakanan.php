<?= $this->extend('Back/template/master') ?>

<?= $this->section('content') ?>
<?php $validationErrors = $this->config->plugins['validation_errors'] ?>
<div class="main-content">
    <div class="col-lg-12">
    <?= form_open_multipart(base_url().'/admin/makanan/saveTambahMakanan'); ?>
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <strong>Tambah Makanan</strong> 99's Coffee
                <a href="/admin/makanan" class="close">
                    <span>&times;</span>
                </a>
            </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="namaMakanan" class=" form-control-label">Nama Makanan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="namaMakanan" name="nama_makanan" placeholder="Masukkan Nama Makanan" class="form-control <?= ($validation->hasError('nama_makanan')) ? 'is-invalid' : '' ?>" value="<?= old('nama_makanan') ?>" maxlength="30" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_makanan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="hargaMakanan" class=" form-control-label">Harga Makanan</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="hargaMakanan" name="harga_makanan" placeholder="Masukkan harga Makanan" class="form-control <?= ($validation->hasError('harga_makanan')) ? 'is-invalid' : '' ?>" value="<?= old('harga_makanan') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga_makanan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="select" class=" form-control-label">Kategori</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="kategori" id="select" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : '' ?>">
                                <option value="">Please select</option>
                                <?php foreach($kategoris as $key => $kategori) : ?>
                                    <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['kategori'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('kategori') ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="gambar" class=" form-control-label">Upload Gambar</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="gambar" name="upload_gambar" class="form-control-file ">
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

