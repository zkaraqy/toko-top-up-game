<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="<?= site_url('/') ?>" class="b-brand text-primary">
                 <span class="fw-bold fs-4 text-gradient">DiamondStore</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="<?= base_url('/admin/users') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Users</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('/admin/games') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-device-gamepad"></i></span>
                        <span class="pc-mtext">Games</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('/admin/payment-methods') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
                        <span class="pc-mtext">Metode Pembayaran</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('/admin/sales') ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-report-analytics"></i></span>
                        <span class="pc-mtext">Penjualan</span>
                    </a>
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