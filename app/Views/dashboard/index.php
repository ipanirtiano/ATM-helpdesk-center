<?= $this->extend('layouts/template') ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php $this->section('content') ?>

<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-shopping-bag mb-2" aria-hidden="true" style="width: 60px; height: 60px"></i><br> Ticket <br>
                        <small><?= 'Total Ticket ' . ' ( ' . $ticket . ' )' ?></small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/ticket">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-user mb-2" aria-hidden="true" style="width: 60px; height: 60px"></i><br> Users <br>
                        <small><?= 'Total Users ' . ' ( ' . $karyawan . ' )' ?></small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/users">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-cog mb-2" aria-hidden="true" style="width: 60px; height: 60px"></i><br> Teknisi <br>
                        <small><?= 'Total Teknisi ' . ' ( ' . $teknisi . ' )' ?></small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/teknisi">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body" style="text-align:center"><i class="fa fa-shopping-bag mb-2" aria-hidden="true" style="width: 60px; height: 60px"></i><br> My Ticket <br>
                        <small><?= 'Total Ticket ' . ' ( ' . $my_ticket . ' )' ?></small></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url(); ?>/views/my-ticket">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header bg-dark text-white">
                        <center>
                            Tiket Terkirim
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1><?= $terkirim; ?></h1>Ticket
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header bg-dark text-white">
                        <center>
                            Tiket Waiting
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1><?= $waiting; ?></h1>Ticket
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header bg-dark text-white">
                        <center>
                            Tiket Dalam Proses
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1><?= $proses; ?></h1>Ticket
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3">
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header bg-dark text-white">
                        <center>
                            Tiket Solved
                        </center>
                    </div>
                    <div class="card-body">
                        <center>
                            <h1><?= $solved; ?></h1>Ticket
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection() ?>