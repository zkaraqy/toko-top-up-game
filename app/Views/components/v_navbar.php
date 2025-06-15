<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-lg">
    <div class="container-fluid px-3">
        <!-- Logo and Store Name -->
        <div class="navbar-brand d-flex align-items-center">
            <img src="<?= base_url('diamond-icon.png') ?>" alt="Logo" class="navbar-logo me-2">
            <span class="fw-bold fs-4 text-gradient">DiamondStore</span>
        </div>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Menu Items -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-semibold px-3" href="<?= base_url('/') ?>">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold px-3" href="<?= base_url('/games') ?>">
                        <i class="fas fa-gamepad me-1"></i>Semua Game
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">

                <!-- Authentication Section -->
                <?php if (session()->get('isLoggedIn')): ?>
                    <!-- User is logged in -->
                    <?php if ((bool) session()->get('userData')['is_admin']): ?>
                        <!-- Admin Menu -->
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-light dropdown-toggle auth-btn" type="button"
                                id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-shield me-1"></i>
                                <?= session()->get('userData')['username'] ?? 'Admin' ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/admin/users') ?>">
                                        <i class="fas fa-users me-2"></i>Kelola User
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/admin/games') ?>">
                                        <i class="fas fa-gamepad me-2"></i>Kelola Game
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/admin/orders') ?>">
                                        <i class="fas fa-shopping-cart me-2"></i>Kelola Order
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Regular User Menu -->
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-light dropdown-toggle auth-btn" type="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i>
                                <?= session()->get('userData')['username'] ?? 'User' ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                        <i class="fas fa-user-circle me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/orders') ?>">
                                        <i class="fas fa-history me-2"></i>Riwayat Transaksi
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('/login') ?>" class="btn btn-outline-light auth-btn d-flex align-items-center gap-1">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                        <a href="<?= base_url('/register') ?>" class="btn btn-primary auth-btn d-flex align-items-center gap-1">
                            <i class="fas fa-user-plus me-1"></i>Daftar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>