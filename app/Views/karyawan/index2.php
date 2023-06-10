<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Karyawan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Karyawan </li>
        </ol>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Karyawan
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
                                        <th>Kode Users</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Departemen</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($karyawan as $data) : ?>
                                        <?php
                                        // create number
                                        $i++;
                                        // get kode user dari model karyawan
                                        $kode_user = $data['kode_user'];

                                        // query manual ke table users by kode use
                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE id_users = '$kode_user'");
                                        // konversi ke array
                                        $data_query = mysqli_fetch_assoc($query);
                                        // get level
                                        $level = $data_query['level'];
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $kode_user; ?></td>
                                            <td><?= $data['nama_lengkap']; ?></td>
                                            <td><?= $data['email']; ?></td>
                                            <td><?= $data['phone']; ?></td>
                                            <td><?= $data['departemen']; ?></td>
                                            <td><?= $level; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>