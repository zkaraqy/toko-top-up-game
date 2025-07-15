<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h3><i class="ti ti-device-gamepad"></i> Games</h3>
                    <span>Kelola Data Game</span>
                </div>
                <div class="">
                    <a href="<?= base_url('/admin/games/form') ?>" class="btn btn-primary">
                        <span class="d-flex gap-1">
                            <i class="ti ti-plus"></i>
                            Tambah
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('title_pesan')) { ?>
                <div class="alert <?= session()->getFlashdata('is_success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show"
                    role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:" width="20" height="20">
                        <use xlink:href="<?= session()->getFlashdata('is_success') ? '#check-circle-fill' : '#exclamation-triangle-fill' ?>" />
                    </svg>
                    <strong><?= session()->getFlashdata('title_pesan'); ?></strong> <?= session()->getFlashdata('body_pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?> <div class="col-md-6 col-12">
                <form method="GET" action="<?= base_url('/admin/games/search') ?>" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control"
                            placeholder="Cari judul atau developer..."
                            value="<?= $q ?? '' ?>">
                        <button class="btn btn-outline-secondary d-flex align-items-center" type="submit">
                            <i class="ti ti-search"></i>
                        </button>
                        <?php if (!empty($q)): ?>
                            <a href="<?= base_url('/admin/games') ?>"
                                class="btn btn-outline-danger d-flex align-items-center">
                                <i class="ti ti-x"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th class="text-center">Foto</th>
                            <th>Judul</th>
                            <th>Developer</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($games)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="ti ti-search-off" style="font-size: 3rem;"></i>
                                        <p class="mt-2">Tidak ada data yang ditemukan</p>
                                        <?php if (!empty($q)): ?>
                                            <p class="small">untuk pencarian: "<strong><?= esc($q) ?></strong>"</p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($games as $game) { ?>
                                <tr id="<?= $game['id'] ?>">
                                    <td class="text-center"><?php echo $no;
                                                            ++$no; ?></td>
                                    <td class="text-center"><img class="rounded"
                                            src="<?= base_url('/assets/images/games/' . $game['path_foto']) ?>"
                                            alt="foto staf" width="100px" height="auto"
                                            style="object-fit: cover"
                                            onerror="this.onerror=null; this.src='<?= base_url('/assets/images/game_default.png') ?>';" />
                                    </td>
                                    <td>
                                        <?= $game['title'] ?>
                                    </td>
                                    <td>
                                        <?= $game['developer'] ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-column">
                                            <a href="<?= base_url('/admin/games/detail/' . $game['id']); ?>" data-bs-toggle="tooltip" data-bs-title="Detail" style="width: max-content;">
                                                <button type="button" class="btn btn-outline-info d-inline-flex p-1"><i
                                                        class="ti ti-info-circle"></i></button>
                                            </a>
                                            <a href="<?= base_url('/admin/games/form/' . $game['id']); ?>" data-bs-toggle="tooltip" data-bs-title="Edit" style="width: max-content;">
                                                <button type="button" class="btn btn-outline-warning d-inline-flex p-1"><i
                                                        class="ti ti-pencil"></i></button>
                                            </a>
                                            <div data-bs-toggle="tooltip" data-bs-title="Hapus" style="width: max-content;">
                                                <button type="button" class="btn btn-outline-danger d-inline-flex p-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalHapus" data-context="games"
                                                    data-id="<?= $game['id'] ?>"><i class="ti ti-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <?= $pager->links('bootstrap', 'bootstrap_pagination') ?>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn:hover {
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
</style>