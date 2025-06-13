<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <!-- <img src="<?= base_url('assets/images/logo-dark.svg') ?>" class="img-fluid logo-lg" alt="logo"> -->
                 <span class="img-fluid logo-lg fs-2 fw-bold font-monospace">ZKAMORCE</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="<?= base_url('/'); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>


                <li class="pc-item pc-caption">
                    <label>Data Master</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-building-store"></i>
                        </span>
                        <span class="pc-mtext">Data Toko</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('/pages/staf') ?>">
                                <span class="pc-micon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="pc-mtext">Staf</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-building-warehouse"></i>
                        </span>
                        <span class="pc-mtext">Data Produk</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('/pages/produk') ?>">
                                <span class="pc-micon">
                                    <i class="ti ti-box"></i>
                                </span>
                                <span class="pc-mtext">Produk</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pc-item pc-caption">
                    <label>Menu Manajemen</label>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('/pages/penjualan') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-currency-dollar"></i></span>
                        <span class="pc-mtext">Penjualan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('/pages/pembelian') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                        <span class="pc-mtext">Pembelian</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('/pages/laporan') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-report-analytics"></i></span>
                        <span class="pc-mtext">Laporan</span>
                    </a>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-accessible"></i></span>
                        <span class="pc-mtext">Akun</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('/profile') ?>">
                                <span class="pc-micon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="pc-mtext">Profile</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('/ganti_password') ?>">
                                <span class="pc-micon">
                                    <i class="ti ti-key"></i>
                                </span>
                                <span class="pc-mtext">Ganti Password</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">Pengaturan</span>
                        <span class="pc-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="<?= base_url('/pengaturan/toko') ?>">
                                <span class="pc-micon">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="pc-mtext">Toko</span>
                            </a>
                        </li>
                    </ul>
                </li>
        </div>
    </div>
</nav>