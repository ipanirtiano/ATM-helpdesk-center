<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Teknisi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Teknisi</li>
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
                                        <th>Kode Tek</th>
                                        <th>Departemen</th>
                                        <th>Kategori</th>
                                        <th>Nama Lengkap</th>
                                        <th>Area Tugas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($teknisi as $data) : ?>
                                        <?php
                                        // create number
                                        $i++;
                                        // get kode user dari model teknisi
                                        $kode_user = $data['kode_user'];

                                        // query manual ke table users by kode user
                                        $query = mysqli_query($conn, "SELECT * FROM karyawan WHERE kode_user = '$kode_user'");
                                        // konversi ke array
                                        $data_query = mysqli_fetch_assoc($query);


                                        // get kode kategori
                                        $kode_kategori = $data['kategori'];
                                        $query = mysqli_query($conn, "SELECT * FROM kategori WHERE kode_kategori = '$kode_kategori'");
                                        // konversi ke array
                                        $query_kategori = mysqli_fetch_assoc($query);
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['kode_tek']; ?></td>
                                            <td><?= $data_query['departemen']; ?></td>
                                            <td><?= $query_kategori['nama_kategori']; ?></td>
                                            <td><?= $data_query['nama_lengkap']; ?></td>
                                            <td><?= $data['area_tugas']; ?></td>
                                            <td>
                                                <?php $kodeTek = base64_encode($data['kode_tek']) ?>
                                                <a href="<?= base_url(); ?>/admin/update-teknisi/<?= $kodeTek; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="<?= base_url(); ?>/admin/delete-teknisi/<?= $kodeTek; ?>" class=" btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-user mr-2" aria-hidden="true"></i>Tambah Teknisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>/teknisi/proses_input" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Kode Tek</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm <?= ($validation->hasError('kode_tek') ? 'is-invalid' : ''); ?>" id="colFormLabelSm" name="kode_tek" value="<?= $kode_tek ?>" readonly>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('kode_tek'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Nama Lengkap</label>
                                <div class="col-md-9">
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
                                            <option value="<?= $data['id_users']; ?>" <?= (old('nama_lengkap') == $data['id_users'] ? 'selected' : ''); ?>><?= $data_query['nama_lengkap']; ?></option>
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
                                            <option value="<?= $data['kode_kategori']; ?>" <?= (old('kategori') == $data['nama_kategori'] ? 'selected' : ''); ?>><?= $data['nama_kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback" style="font-size: small">
                                        <?= $validation->getError('kategori'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label">Area Tugas</label>
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