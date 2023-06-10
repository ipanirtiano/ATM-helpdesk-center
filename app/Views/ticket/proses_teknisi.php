<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Progres</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Assigment Ticket</li>
                    <li class="breadcrumb-item active">Update Progres</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-envelope-open mr-2" aria-hidden="true"></i> Update Progres
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

                        <form action="<?= base_url(); ?>/ticket/proses_update_progres/<?= $ticket['kode_ticket']; ?>" method="POST">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label"><b>Up Progres</b></label>
                                        <select class="form-control form-control mb-2 <?= ($validation->hasError('progres') ? 'is-invalid' : ''); ?>" name="progres">
                                            <option selected="selected" value=" ">-- PILIH --</option>
                                            <option value="0" <?= ($ticket['progres'] == '0' ? 'selected' : ''); ?>>PROGRES 0%</option>
                                            <option value="10" <?= ($ticket['progres'] == '10' ? 'selected' : ''); ?>>PROGRES 10%</option>
                                            <option value="20" <?= ($ticket['progres'] == '20' ? 'selected' : ''); ?>>PROGRES 20%</option>
                                            <option value="30" <?= ($ticket['progres'] == '30' ? 'selected' : ''); ?>>PROGRES 30%</option>
                                            <option value="40" <?= ($ticket['progres'] == '40' ? 'selected' : ''); ?>>PROGRES 40%</option>
                                            <option value="50" <?= ($ticket['progres'] == '50' ? 'selected' : ''); ?>>PROGRES 50%</option>
                                            <option value="60" <?= ($ticket['progres'] == '60' ? 'selected' : ''); ?>>PROGRES 60%</option>
                                            <option value="70" <?= ($ticket['progres'] == '70' ? 'selected' : ''); ?>>PROGRES 70%</option>
                                            <option value="80" <?= ($ticket['progres'] == '80' ? 'selected' : ''); ?>>PROGRES 80%</option>
                                            <option value="90" <?= ($ticket['progres'] == '90' ? 'selected' : ''); ?>>PROGRES 90%</option>
                                            <option value="100" <?= ($ticket['progres'] == '100' ? 'selected' : ''); ?>>PROGRES 100%</option>
                                        </select>
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('progres'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <div class="mb-3">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:  <?= $ticket['progres'] . '%' ?>" aria-valuenow="<?= $ticket['progres']; ?>" aria-valuemin="<?= $ticket['progres']; ?>" aria-valuemax="100"><?= $ticket['progres']; ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Deskripsi Progres</label>
                                            <textarea class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : ''); ?>" id="exampleFormControlTextarea1" rows="3" name="deskripsi"><?= old('deskripsi'); ?></textarea>
                                            <div class="invalid-feedback" style="font-size: small">
                                                <?= $validation->getError('deskripsi'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane mr-3" aria-hidden="true"></i>Kirim</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>