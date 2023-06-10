<?= $this->extend('layouts/template') ?>
<?= date_default_timezone_set('Asia/Jakarta');; ?>
<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <h1 class="mt-4">New Ticket</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">New Ticket</li>
                </ol>

                <div class="card">
                    <div class="card-body">
                        <div class="card mb-3">
                            <form action="<?= base_url(); ?>/ticket/proses_input" method="POST">
                                <?= csrf_field(); ?>
                                <div class="card-header">
                                    <i class="fa fa-user mr-3" aria-hidden="true"></i> Data Pelapor
                                </div>
                                <div class="card-body">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Kode Ticket</label>
                                                <input type="text" class="form-control" value="<?= $kode_tiket; ?>" readonly name="kode_ticket">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama Pemesan</label>
                                                <input type="text" class="form-control" value="<?= $karyawan['nama_lengkap']; ?>" readonly>
                                                <input type="hidden" class="form-control" value="<?= $karyawan['kode_user']; ?>" readonly name="kode_user">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                                <input type="text" class="form-control datepicker <?= ($validation->hasError('tanggal') ? 'is-invalid' : ''); ?>" value="<?= date('Y-m-d H:i:s') ?>" name="tanggal" readonly>
                                                <div class="invalid-feedback" style="font-size: small">
                                                    <?= $validation->getError('tanggal'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Departemen</label>
                                                <input type="text" class="form-control" value="<?= $karyawan['departemen']; ?>" readonly name="departemen">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="text" class="form-control" value="<?= $karyawan['email']; ?>" readonly name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Phone/EXT</label>
                                                <input type="text" class="form-control" value="<?= $karyawan['phone']; ?>" readonly name="phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="card">
                            <form action="" method="POST">
                                <div class="card-header">
                                    <i class="fas fa-list-alt mr-3"></i> Deskripsi Masalah
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Kategori Masalah</label>
                                                <select class="form-control form-control mb-2 <?= ($validation->hasError('kategori') ? 'is-invalid' : ''); ?>" name="kategori">
                                                    <option selected="selected" value=" ">-- PILIH --</option>
                                                    <?php foreach ($kategori as $data) : ?>
                                                        <option value="<?= $data['nama_kategori']; ?>" <?= (old('kateogori') == $data['nama_kategori'] ? 'selected' : ''); ?>><?= $data['nama_kategori']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback" style="font-size: small">
                                                    <?= $validation->getError('kategori'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Subject Masalah</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('subject') ? 'is-invalid' : ''); ?>" onkeyup="this.value = this.value.toUpperCase();" name="subject" value=" <?= old('subject'); ?>">
                                                <div class="invalid-feedback" style="font-size: small">
                                                    <?= $validation->getError('subject'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">ATM Area</label>
                                                <select class="form-control form-control mb-2 <?= ($validation->hasError('atm') ? 'is-invalid' : ''); ?>" name="atm">
                                                    <option selected="selected" value=" ">-- PILIH --</option>
                                                    <?php foreach ($atm as $data) : ?>

                                                        <option value="<?= $data['nama_atm']; ?>"><?= $data['nama_atm']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback" style="font-size: small">
                                                    <?= $validation->getError('atm'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Urgency Masalah</label>
                                                <select class="form-control form-control mb-2 <?= ($validation->hasError('urgency') ? 'is-invalid' : ''); ?>" name="urgency">
                                                    <option selected="selected" value=" ">-- PILIH --</option>
                                                    <option value="mendesak">MENDESAK (Proses 1 Hari)</option>
                                                </select>
                                                <div class="invalid-feedback" style="font-size: small">
                                                    <?= $validation->getError('urgency'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8 mb-2">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Deskripsi Masalah</label>
                                                    <textarea class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="deskripsi"><?= old('deskripsi'); ?></textarea>
                                                    <div class="invalid-feedback" style="font-size: small">
                                                        <?= $validation->getError('deskripsi'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                        <a href="<?= base_url(); ?>/views" class="btn btn-danger mt-3">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>