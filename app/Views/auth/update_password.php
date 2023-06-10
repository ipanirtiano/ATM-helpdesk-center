<?= $this->extend('layouts/template') ?>

<?php $this->section('content') ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">


        <div class="row">
            <div class="col">
                <h1 class="mt-4">Update Password</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Update Password</li>
                </ol>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user mr-2" aria-hidden="true"></i> Update Password
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('pesan-success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan-success'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form action="<?= base_url(); ?>/Auth/proses_update_password" method="post">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Password Lama</label>
                                        <input type="password" class="form-control col-5 <?= ($validation->hasError('password_lama') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="password_lama" placeholder="Password Lama">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('password_lama'); ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control col-5 <?= ($validation->hasError('password_baru') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="password_baru" placeholder="Password Lama">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('password_baru'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control col-5 <?= ($validation->hasError('konfirmasi_password') ? 'is-invalid' : ''); ?>" id="exampleFormControlInput1" name="konfirmasi_password" placeholder="Password Lama">
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('konfirmasi_password'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-info">Update Password</button>
                                    <a href="<?= base_url(); ?>/" class="btn btn-sm btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>