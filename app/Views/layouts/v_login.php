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
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
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
                </div>
                <div class="card my-5 shadow-sm">
                    <?= form_open('login/submit', ['method' => 'POST', 'autocomplete' => 'off']) ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Login</b></h3>
                            <a href="<?= site_url(relativePath: '/register') ?>" class="link-primary">Belum punya akun?</a>
                        </div> <?php if (session()->getFlashdata('is_negative_response') === true || session()->getFlashdata('is_negative_response') === false) { ?>
                            <div class="alert <?= session()->getFlashdata('is_negative_response') ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show"
                                role="alert">
                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="20" height="20">
                                    <use xlink:href="<?= session()->getFlashdata('is_negative_response') ? '#exclamation-triangle-fill' : '#check-circle-fill' ?>" />
                                </svg>
                                <?= session()->getFlashdata('message'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Email atau Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= (session('errors.username_or_email')) ? 'is-invalid' : '' ?>"
                                name="username_or_email" placeholder="Masukkan alamat email atau username..."
                                value="<?= old('username_or_email') ?>">
                            <?php if (session('errors.username_or_email')) : ?>
                                <div class="text-danger"><?= session('errors.username_or_email') ?></div>
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
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Login</button>
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



</body>
<!-- [Body] end -->

</html>