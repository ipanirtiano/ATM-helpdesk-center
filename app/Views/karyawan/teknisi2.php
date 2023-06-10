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