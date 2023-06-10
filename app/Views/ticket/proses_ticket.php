<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Proses Ticket</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">List Ticket</li>
                    <li class="breadcrumb-item active">Proses Ticket</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-envelope-open mr-2" aria-hidden="true"></i> Detail Ticket
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <i class="fa  fa-sticky-note mr-2" aria-hidden="true"></i> Ticket : <?= $ticket['kode_ticket']; ?>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"> <i class="fa fa-calendar mr-3" aria-hidden="true"></i> <b><?= $ticket['tanggal']; ?></b> </li>
                                            <li class="list-group-item"><i class="fa fa-briefcase mr-3" aria-hidden="true"></i> <b><?= $ticket['kategori']; ?></b> </li>
                                            <li class="list-group-item"><i class="fa fa-briefcase mr-3" aria-hidden="true"></i> <b><?= $ticket['subject']; ?></b> </li>
                                            <li class="list-group-item"><i class="fa fa-user mr-3" aria-hidden="true"></i> <b><?= $pemesan['nama_lengkap'] ?></b> </li>
                                            <li class="list-group-item"><i class="fa fa-briefcase mr-3" aria-hidden="true"></i> <b><?= $ticket['atm'] ?></b> </li>
                                        </ul>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if ($ticket['kode_teknisi'] == 'Null') { ?>
                            <form action="<?= base_url(); ?>/ticket/proses_update/<?= $ticket['kode_ticket']; ?>" method="POST">
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label"><b>Pilih Teknisi</b></label>
                                            <select class="form-control form-control mb-2 <?= ($validation->hasError('teknisi') ? 'is-invalid' : ''); ?>" name="teknisi">
                                                <option selected="selected" value=" ">-- PILIH --</option>
                                                <?php foreach ($teknisi as $data) : ?>
                                                    <?php
                                                    // get kode user
                                                    $kode_user = $data['kode_user'];
                                                    $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
                                                    // koneksi manual 
                                                    $query = mysqli_query($conn, "SELECT * FROM karyawan WHERE kode_user = '$kode_user'");
                                                    // konversi ke array
                                                    $data_query = mysqli_fetch_assoc($query);
                                                    ?>
                                                    <option value="<?= $data['kode_user']; ?>"><?= $data_query['nama_lengkap']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('teknisi'); ?>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane mr-3" aria-hidden="true"></i>Kirim</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <i class="fa  fa-user mr-2" aria-hidden="true"></i> Di Proses Oleh (Teknisi)
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <?php if ($ticket['status'] == 'Proses Teknisi') { ?>
                                                    <li class="list-group-item"> <b>Teknisi :</b><b><?= ' ' . $nama_teknisi ?></b> </li>
                                                    <li class="list-group-item"> <b>Phone :</b><b><?= ' ' . $phone ?></b> </li>
                                                    <li class="list-group-item">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:  <?= $ticket['progres'] . '%' ?>" aria-valuenow="<?= $ticket['progres']; ?>" aria-valuemin="<?= $ticket['progres']; ?>" aria-valuemax="100"><?= $ticket['progres']; ?>%</div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item"><b>Progres</b> <button class="btn btn-sm btn-primary"><?= $ticket['progres']; ?>%</button></li>

                                                    <li class="list-group-item"><b>Tanggal Ticket : <?= $ticket['tanggal']; ?></b> </li>
                                                    <li class="list-group-item"><b>Approve Ticket : <?= $ticket['tgl_approve_teknisi']; ?></b> </li>
                                                    <li class="list-group-item"><b>Teknisi in Area : <?= $ticket['tanggal_proses']; ?></b> </li>
                                                    <li class="list-group-item"><b>Tanggal Proses : <?= $ticket['tanggal_proses']; ?></b> </li>
                                                    <li class="list-group-item"><b>Status Ticket : </b><span class="badge bg-info px-2 py-1"><i class="fa fa fa-cogs mr-2" aria-hidden="true"></i><b> <?= $ticket['status']; ?></b></span> </li>

                                                <?php } elseif ($ticket['status'] == 'Solved') { ?>
                                                    <li class="list-group-item"> <b>Teknisi :</b><b><?= ' ' . $nama_teknisi ?></b> </li>
                                                    <li class="list-group-item"> <b>Phone :</b><b><?= ' ' . $phone ?></b> </li>
                                                    <li class="list-group-item">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:  <?= $ticket['progres'] . '%' ?>" aria-valuenow="<?= $ticket['progres']; ?>" aria-valuemin="<?= $ticket['progres']; ?>" aria-valuemax="100"><?= $ticket['progres']; ?>%</div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item"><b>Progres</b> <button class="btn btn-sm btn-primary"><?= $ticket['progres']; ?>%</button></li>

                                                    <li class="list-group-item"><b>Tanggal Ticket : <?= $ticket['tanggal']; ?></b> </li>
                                                    <li class="list-group-item"><b>Approve Ticket : <?= $ticket['tgl_approve_teknisi']; ?></b> </li>
                                                    <li class="list-group-item"><b>Teknisi in Area : <?= $ticket['tanggal_proses']; ?></b> </li>
                                                    <li class="list-group-item"><b>Tanggal Proses : <?= $ticket['tanggal_proses']; ?></b> </li>
                                                    <li class="list-group-item"><b>Tanggal Solved : <?= $ticket['tanggal_solved']; ?></b> </li>
                                                    <li class="list-group-item"><b>Status Ticket : </b><span class="badge bg-primary px-2 py-1"><i class="fa fa-check-circle mr-2" aria-hidden="true"></i><b> <?= $ticket['status']; ?></b></span> </li>
                                                <?php } else { ?>
                                                    <li class="list-group-item"><b>Tanggal Ticket : <?= $ticket['tanggal']; ?></b> </li>
                                                    <li class="list-group-item"><b>Status Ticket : </b><span class="badge bg-dark px-2 py-1"><i class="fa fa-hourglass-start mr-2" aria-hidden="true"></i><b> <?= $ticket['status']; ?></b></span> </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>