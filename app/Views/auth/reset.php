<?= $this->extend('layouts/login'); ?>

<?= $this->section('content'); ?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row mt-5"></div>
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-2">Email Address</h3>
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
                                <form action="<?= base_url(); ?>/auth/proses_reset" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4 <?= ($validation->hasError('email') ? 'is-invalid' : ''); ?>" id="inputEmailAddress" type="text" placeholder="Enter email address" name="email" value="<?= old('email'); ?>" />
                                        <div class="invalid-feedback" style="font-size: small">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary btn-block" type="submit">Sumbit</button>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-2 mb-0">
                                        <a class="btn btn-danger btn-block" type="submit" href="<?= base_url('/'); ?>">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div> -->
</div>

<?= $this->endSection(); ?>