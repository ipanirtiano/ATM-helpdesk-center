<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Data ATM</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data ATM</li>
        </ol>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Data</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Teknisi
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode ATM</th>
                                        <th>Nama ATM</th>
                                        <th>Alamat</th>
                                        <th>Area</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($atm as $data) :

                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['kode_atm']; ?></td>
                                            <td><?= $data['nama_atm']; ?></td>
                                            <td><?= $data['alamat']; ?></td>
                                            <td><?= $data['Area']; ?></td>
                                            <td>
                                                <?php $kodeTek = base64_encode($data['kode_atm']) ?>
                                                <a href="<?= base_url(); ?>/admin/update-atm/<?= $kodeTek; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="<?= base_url(); ?>/admin/delete-atm/<?= $kodeTek; ?>" class=" btn btn-sm btn-danger tombol-hapus">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered 	modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-user mr-2" aria-hidden="true"></i>Tambah Data ATM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>/atm/proses_input" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kode ATM</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_atm') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_atm" value="<?= $kode_tek ?>" readonly>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('kode_atm'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama ATM</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control <?= ($validation->hasError('nama_atm') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="nama_atm" value="<?= old('nama_atm'); ?>" placeholder="Nama ATM">
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('nama_atm'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Alamat ATM</label>
                                <div class="col-md-9">

                                    <textarea class="form-control <?= ($validation->hasError('alamat_atm') ? 'is-invalid' : ''); ?>" placeholder="Alamat ATM" id="floatingTextarea2" style="height: 100px" name="alamat_atm"></textarea>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('nama_atm'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Area ATM</label>
                                <div class="col-md-9">
                                    <select class="form-control form-control mb-2 <?= ($validation->hasError('area') ? 'is-invalid' : ''); ?>" name="area">
                                        <option selected="selected" value=" ">-- PILIH --</option>
                                        <option value="Jakarta Selatan"> Jakarta Selatan </option>
                                        <option value="Jakarta Barat"> Jakarta Barat </option>
                                        <option value="Jakarta Utara"> Jakarta Utara </option>
                                        <option value="Jakarta Pusat"> Jakarta Pusat </option>
                                        <option value="Bogor"> Bogor </option>
                                        <option value="Tangerang"> Tangerang </option>
                                        <option value="Bekasi"> Bekasi </option>
                                    </select>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('area'); ?>
                                    </div>
                                </div>
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Input</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->endSection() ?>