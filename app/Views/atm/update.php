<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Data</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">ATM</li>
                    <li class="breadcrumb-item active">Update</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user mr-2" aria-hidden="true"></i> Update Data ATM
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <?php $kodeUser = base64_encode($data_atm['kode_atm']); ?>
                                <form action="<?= base_url(); ?>/atm/proses_update/<?= $kodeUser; ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Kode ATM</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_atm') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_atm" value="<?= $data_atm['kode_atm'] ?>" readonly>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('kode_atm'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama ATM</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control <?= ($validation->hasError('nama_atm') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama_atm" value="<?= $data_atm['nama_atm'] ?>" placeholder="Nama ATM">
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('nama_atm'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Alamat ATM</label>
                                        <div class="col-md-9">

                                            <textarea class="form-control <?= ($validation->hasError('alamat_atm') ? 'is-invalid' : ''); ?>" placeholder="Alamat ATM" id="floatingTextarea2" style="height: 100px" name="alamat_atm"><?= $data_atm['alamat'] ?></textarea>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('nama_atm'); ?>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-sm btn-info">Update</button>
                                    <a href="<?= base_url(); ?>/admin/atm" class="btn btn-sm btn-danger">Cancel</a>
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