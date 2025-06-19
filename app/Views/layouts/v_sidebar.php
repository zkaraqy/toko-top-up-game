<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center">
            <a href="<?= site_url('/') ?>" class="b-brand text-primary">
                 <span class="fw-bold fs-4 text-gradient">Toko Top-up Game</span>
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
        </div>
    </div>
</nav>