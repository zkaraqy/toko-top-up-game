<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title><?= esc($title) ?></title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('diamond-icon.png') ?>">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/tabler-icons.min.css') ?>">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/feather.css') ?>">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/fontawesome.css') ?>">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/material.css') ?>">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" id="main-style-link">
    <link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css') ?>">
    <style>
        div.text-danger {
            font-size: 12px;
        }
    </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="<?= site_url('/') ?>" class="link-secondary">kembali ke beranda</a>
                </div>
                <div class="card my-5 shadow-sm">
                    <?= form_open('register/submit', ['method' => 'POST', 'autocomplete' => 'off']) ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Daftar</b></h3>
                            <a href="<?= site_url('/login') ?>" class="link-primary">Udah punya akun?</a>
                        </div>
                        <?php if (session()->getFlashdata('is_negative_response')) { ?>
                            <div class="alert <?= session()->getFlashdata('is_negative_response') ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show"
                                role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:" width="20" height="20">
                                    <use xlink:href="<?= session()->getFlashdata('is_negative_response') ? '#exclamation-triangle-fill' : 'check-circle-fill' ?>" />
                                </svg>
                                <?= session()->getFlashdata('message'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" name="nama" placeholder="Masukkan nama..." value="<?= old('nama') ?>">
                                    <?php if (session('errors.nama')) : ?>
                                        <div class="text-danger"><?= session('errors.nama') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= (session('errors.username')) ? 'is-invalid' : '' ?>" name="username" placeholder="Masukkan username..." value="<?= old('username') ?>">
                            <?php if (session('errors.username')) : ?>
                                <div class="text-danger"><?= session('errors.username') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control <?= (session('errors.email')) ? 'is-invalid' : '' ?>" name="email" placeholder="Masukkan alamat email..." value="<?= old('email') ?>">
                            <?php if (session('errors.email')) : ?>
                                <div class="text-danger"><?= session('errors.email') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10 pe-0">
                                    <input id="input-password" type="password" class="form-control <?= (session('errors.password')) ? 'is-invalid' : '' ?>"
                                        name="password" placeholder="Masukkan password..." value="<?= old('password') ?>">
                                </div>
                                <div class="col-2 d-flex">
                                    <button id="toggle-password" type="button" class="btn btn-warning d-flex align-items-center">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <?php if (session('errors.password')) : ?>
                                    <div class="col-10">
                                        <div class="text-danger"><?= session('errors.password') ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="auth-footer row">
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="<?= base_url('assets/js/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/fonts/custom-font.js') ?>"></script>
    <script src="<?= base_url('assets/js/pcoded.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>




    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>


    <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="pct-body" style="height: calc(100% - 60px)">
            <div class="offcanvas-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-layout-sidebar f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Theme Layout</h6>
                                    <span>Choose your layout</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse1">
                            <div class="pct-content">
                                <div class="pc-rtl">
                                    <p class="mb-1">Direction</p>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                                        <label class="form-check-label" for="layoutmodertl">RTL</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-brush f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Theme Mode</h6>
                                    <span>Choose light or dark mode</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse2">
                            <div class="pct-content">
                                <div class="theme-color themepreset-color theme-layout">
                                    <a href="#!" class="active" onclick="layout_change('light')" data-value="false"><span><img src="../assets/images/customization/default.svg" alt="img"></span><span>Light</span></a>
                                    <a href="#!" class="" onclick="layout_change('dark')" data-value="true"><span><img src="../assets/images/customization/dark.svg" alt="img"></span><span>Dark</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-color-swatch f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Color Scheme</h6>
                                    <span>Choose your primary theme color</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse3">
                            <div class="pct-content">
                                <div class="theme-color preset-color">
                                    <a href="#!" class="active" data-value="preset-1"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 1</span></a>
                                    <a href="#!" class="" data-value="preset-2"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 2</span></a>
                                    <a href="#!" class="" data-value="preset-3"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 3</span></a>
                                    <a href="#!" class="" data-value="preset-4"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 4</span></a>
                                    <a href="#!" class="" data-value="preset-5"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 5</span></a>
                                    <a href="#!" class="" data-value="preset-6"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 6</span></a>
                                    <a href="#!" class="" data-value="preset-7"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 7</span></a>
                                    <a href="#!" class="" data-value="preset-8"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 8</span></a>
                                    <a href="#!" class="" data-value="preset-9"><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 9</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item pc-boxcontainer">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-border-inner f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Layout Width</h6>
                                    <span>Choose fluid or container layout</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse4">
                            <div class="pct-content">
                                <div class="theme-color themepreset-color boxwidthpreset theme-container">
                                    <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img src="../assets/images/customization/default.svg" alt="img"></span><span>Fluid</span></a>
                                    <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img src="../assets/images/customization/container.svg" alt="img"></span><span>Container</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-typography f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Font Family</h6>
                                    <span>Choose your font family.</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse5">
                            <div class="pct-content">
                                <div class="theme-color fontpreset-color">
                                    <a href="#!" class="active" onclick="font_change('Public-Sans')" data-value="Public-Sans"><span>Aa</span><span>Public Sans</span></a>
                                    <a href="#!" class="" onclick="font_change('Roboto')" data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                                    <a href="#!" class="" onclick="font_change('Poppins')" data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                                    <a href="#!" class="" onclick="font_change('Inter')" data-value="Inter"><span>Aa</span><span>Inter</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="collapse show">
                            <div class="pct-content">
                                <div class="d-grid">
                                    <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<!-- [Body] end -->

</html>