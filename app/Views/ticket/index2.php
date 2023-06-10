<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Data Ticket</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Ticket</li>
        </ol>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable List Ticket
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
                                        <th>Id Ticket</th>
                                        <th>Tanggal Ticket</th>
                                        <th>ATM</th>
                                        <th>Kategori</th>
                                        <th>Subject Problem</th>
                                        <th>Detail Problem</th>
                                        <th>Progres (%)</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // koneksi database manual
                                    $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
                                    ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($ticket as $data) : ?>
                                        <?php
                                        // create number
                                        $i++;
                                        // get kode user dari model karyawan
                                        $kode_user = $data['kode_pemesan'];

                                        // query manual ke table users by kode use
                                        $query = mysqli_query($conn, "SELECT * FROM karyawan WHERE kode_user = '$kode_user'");
                                        // konversi ke array
                                        $data_query = mysqli_fetch_assoc($query);

                                        $bg = '';
                                        if ($data['status'] == 'Proses Teknisi') {
                                            $bg = 'bg-light';
                                        }


                                        ?>
                                        <tr class="<?= $bg; ?>">
                                            <td><?= $i; ?></td>
                                            <td class="text-nowrap"><?= $data['kode_ticket']; ?></td>
                                            <td class="text-nowrap"><?= $data['tanggal']; ?></td>
                                            <td class="text-nowrap"><?= $data['atm']; ?></td>
                                            <td class="text-nowrap"><?= $data['kategori']; ?></td>
                                            <td class="text-nowrap"><?= $data['subject']; ?></td>
                                            <td class="text-nowrap"><?= $data['deskripsi']; ?></td>
                                            <td class="text-nowrap"><?= $data['progres']; ?>%</td>
                                            <td class="text-nowrap"><?= $data['status']; ?></td>
                                            <td class="text-nowrap"><?= $data_query['nama_lengkap']; ?></td>
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