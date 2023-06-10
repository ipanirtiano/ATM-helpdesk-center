<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Data</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Teknisi</li>
                    <li class="breadcrumb-item active">Update</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user mr-2" aria-hidden="true"></i> Update Data Teknisi
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <?php $kodeTek = base64_encode($data_teknisi['kode_tek']); ?>
                                <form action="<?= base_url(); ?>/teknisi/proses_update/<?= $kodeTek; ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kode Tek</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_tek') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_tek" value="<?= $data_teknisi['kode_tek'] ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_tek'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama Lengkap</label>
                                        <div class="col-md-9">
                                            <?php $conn = mysqli_connect('localhost', 'root', '', 'helpdesk'); ?>
                                            <select class="form-control form-control mb-2 <?= ($validation->hasError('nama_lengkap') ? 'is-invalid' : ''); ?>" name="nama_lengkap">
                                                <option selected="selected" value=" ">Nama Lengkap</option>
                                                <?php foreach ($karyawan as $data) : ?>
                                                    <?php
                                                    // get kode user
                                                    $kode_user = $data['id_users'];
                                                    // koneksi manual 
                                                    $query = mysqli_query($conn, "SELECT * FROM karyawan WHERE kode_user = '$kode_user'");
                                                    // konversi ke array
                                                    $data_query = mysqli_fetch_assoc($query);
                                                    ?>
                                                    <option value="<?= $data['id_users']; ?>" <?= ($data_teknisi['kode_user'] == $data['id_users'] ? 'selected' : ''); ?>><?= $data_query['nama_lengkap']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('nama_lengkap'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kategori</label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control mb-2 <?= ($validation->hasError('kategori') ? 'is-invalid' : ''); ?>" name="kategori">
                                                <option selected="selected" value=" ">Kategori</option>
                                                <?php foreach ($kategori as $data) : ?>
                                                    <option value="<?= $data['kode_kategori']; ?>" <?= ($data_teknisi['kategori'] == $data['kode_kategori'] ? 'selected' : ''); ?>><?= $data['nama_kategori']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kategori'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-info">Update</button>
                                    <a href="<?= base_url(); ?>/admin/teknisi" class="btn btn-sm btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>