<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title><?= $title  ?></title>
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

    <!-- data tables css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/plugins/dataTables.bootstrap5.min.css') ?>">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
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
    <!-- [ Sidebar Menu ] start -->
    <?= view('layouts/v_sidebar'); ?>
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <?= view('layouts/v_topbar'); ?>
    <!-- [ Header ] end -->


    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <?php if (isset($breadcrumb)) { ?>
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <?php foreach ($breadcrumb as $data) { ?>
                                        <li class="breadcrumb-item"><a
                                                href="<?= base_url($data['link']) ?>"><?= $data['title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <?= view($content) ?>
            <!-- [ Main Content ] end -->


        </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="<?= base_url('/') ?>">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>
    <div class="modal fade" id="modalResetPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-dark">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Reset Password User
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="text-center mb-3">
                        <i class="ti ti-alert-triangle text-warning" style="font-size: 3rem;"></i>
                    </div> -->
                    <p class=" mb-0">
                        Yakin ingin reset password user ini?
                    </p>
                    <!-- <p class="text-center text-muted">
                        Password baru akan digenerate secara otomatis dan ditampilkan setelah proses berhasil.
                    </p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i>Batal
                    </button>
                    <button type="button" id="tombol-yakin-modal-reset-password" class="btn btn-warning d-flex align-items-center">
                        <span id="spinner-tombol-modal-reset-password" class="d-none spinner-border spinner-border-sm me-2" role="status"></span>
                        Ya, Reset Password
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Silahkan coba lagi
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal">
                        <i class="ti ti-x me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin ingin menghapus?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda tidak bisa mengembalikan data yang telah terhapus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modal-btn-negative" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="modal-btn-positive" class="btn btn-danger">
                        <span id="spinner-tombol-modal-hapus" class="d-none spinner-border spinner-border-sm" role="status"></span>
                        Ya, lanjutkan
                    </button>
                    <!-- <button type="button" id="modal-btn-positive" class="btn btn-danger">Ya, lanjutkan</button> -->
                </div>
            </div>
        </div>
    </div>


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