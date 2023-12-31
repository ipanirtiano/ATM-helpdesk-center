<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-sm btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Kategori</button>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Kategori
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
                                        <th>Kode Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($kategori as $data) : ?>
                                        <?php $i++ ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['kode_kategori']; ?></td>
                                            <td><?= $data['nama_kategori']; ?></td>
                                            <td>
                                                <?php $kodeDept = base64_encode($data['kode_kategori']) ?>
                                                <a href="<?= base_url(); ?>/admin/update-kategori/<?= $kodeDept; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="<?= base_url(); ?>/admin/delete-kategori/<?= $kodeDept; ?>" class=" btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>/kategori/proses_input" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kode Kategori</label>
                                <input type="text" class="form-control <?= ($validation->hasError('kode_kategori') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" readonly value="<?= $kode_kategori; ?>" name="kode_kategori">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('kode_kategori'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control <?= ($validation->hasError('nama_kategori') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="nama_kategori" onkeyup="this.value = this.value.toUpperCase();">
                                <div class="invalid-feedback" style="font-size: small">
                                    <?= $validation->getError('nama_kategori'); ?>
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
<?php $this->endSection() ?> x