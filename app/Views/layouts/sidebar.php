<div id="layoutSidenav">
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- jika yang login adalah admin -->
                    <?php if (session('level') == 'Admin') : ?>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="<?= base_url('/views'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt mr-1"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="<?= base_url(); ?>/admin/atm">
                            <div class="sb-nav-link-icon"><i class="fas fa-folder-open mr-1"></i></div>
                            Data ATM
                        </a>
                        <a class="nav-link" href="<?= base_url(); ?>/views/new-ticket">
                            <div class="sb-nav-link-icon"><i class="fas fa-folder-open mr-1"></i></div>
                            New Ticket
                        </a>
                        <a class="nav-link" href="<?= base_url('admin/list-ticket'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt mr-1"></i></div>
                            List Ticket
                        </a>
                        <a class="nav-link" href="<?= base_url(); ?>/views/my-ticket">
                            <div class="sb-nav-link-icon"><i class="fa fa-envelope-open mr-1" aria-hidden="true"></i></div>
                            My Ticket
                        </a>


                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fas fa-tasks icon-label mr-1" aria-hidden="true"></i></div>
                            Master Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url(); ?>/admin/departemen">
                                    <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                                    Departemen
                                </a>
                                <a class="nav-link" href="<?= base_url(); ?>/admin/users">
                                    <div class="sb-nav-link-icon"><i class="fa fa-user mr-1" aria-hidden="true"></i></div>
                                    Karyawan
                                </a>
                            </nav>
                        </div>

                        <a class="nav-link" href="<?= base_url(); ?>/admin/kategori">
                            <div class="sb-nav-link-icon"><i class="fa fa-folder mr-1" aria-hidden="true"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link" href="<?= base_url(); ?>/admin/teknisi">
                            <div class="sb-nav-link-icon"><i class="fa fa-cog mr-1" aria-hidden="true"></i></div>
                            Teknisi
                        </a>
                    <?php endif; ?>
                    <!-- akhir sidebar admin -->

                    <!-- jika yang login adalah Teknisi -->
                    <?php if (session('level') == 'Teknisi') : ?>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="<?= base_url('/views'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt mr-1"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="<?= base_url(); ?>/views/assigment-ticket">
                            <div class="sb-nav-link-icon"><i class="fa fa-envelope-open mr-1" aria-hidden="true"></i></div>
                            Assigment Ticket
                        </a>
                    <?php endif; ?>
                    <!-- akhir sidebar teknisi -->


                    <!-- jika yang login adalah Respon Handler -->
                    <?php if (session('level') == 'Respon Handler') : ?>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="<?= base_url('/views'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt mr-1"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="<?= base_url(); ?>/views/new-ticket">
                            <div class="sb-nav-link-icon"><i class="fas fa-folder-open mr-1"></i></div>
                            New Ticket
                        </a>
                        <a class="nav-link" href="<?= base_url('views/list-ticket'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt mr-1"></i></div>
                            List Ticket
                        </a>
                        <a class="nav-link" href="<?= base_url(); ?>/views/my-ticket">
                            <div class="sb-nav-link-icon"><i class="fa fa-envelope-open mr-1" aria-hidden="true"></i></div>
                            My Ticket
                        </a>

                    <?php endif; ?>
                    <!-- akhir sidebar Respon Handler -->

                    <a class="nav-link" href="<?= base_url(); ?>/views/update-password">
                        <div class="sb-nav-link-icon"><i class="fa fa-unlock-alt mr-1" aria-hidden="true"></i></div>
                        Update Password
                    </a>

                    <a class="nav-link tombol-logout" href="<?= base_url('auth/logout'); ?>">
                        <div class="sb-nav-link-icon"><i class="fa fa-power-off icon-label mr-1" aria-hidden="true"></i></div>
                        Logout
                    </a>


                </div>
            </div>
        </nav>
    </div>

    <?= $this->renderSection('content'); ?>

</div>