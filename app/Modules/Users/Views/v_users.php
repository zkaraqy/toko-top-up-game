<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h3><i class="ti ti-users"></i> Users</h3>
                    <span>Kelola Data User</span>
                </div>
                <div class="">
                    <a href="<?= base_url('/admin/users/form') ?>" class="btn btn-primary">
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
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th class="text-center">Foto</th>
                            <th>Nama (username)</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($users as $user) { ?>
                            <tr id="<?= $user['id'] ?>">
                                <td class="text-center"><?php echo $no;
                                                        ++$no; ?></td>
                                <td class="text-center"><img class="rounded"
                                        src="/assets/images/pengguna/<?= $user['path_foto'] ?>"
                                        alt="foto staf" width="100px" height="auto"
                                        style="object-fit: cover"
                                        onerror="this.onerror=null; this.src='/assets/images/blank-avatar.png';" />
                                </td>
                                <td>
                                    <?= $user['nama'] ?> (<?= $user['username'] ?>)
                                </td>
                                <td>
                                    <span class="d-flex gap-1 align-items-center"><?= !empty($user['email']) ? "<i class='ti ti-mail'></i> {$user['email']}" : "" ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge rounded-pill bg-<?= (bool) $user['status'] ? 'success' : 'secondary' ?>"><?= $user['status'] ? 'Aktif' : 'Non-aktif' ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-1 flex-column">
                                        <a href="<?= base_url('/admin/users/detail/' . $user['id']); ?>" data-bs-toggle="tooltip" data-bs-title="Detail" style="width: max-content;">
                                            <button type="button" class="btn btn-outline-info d-inline-flex p-1"><i
                                                    class="ti ti-info-circle"></i></button>
                                        </a>
                                        <a href="<?= base_url('/admin/users/form/' . $user['id']); ?>" data-bs-toggle="tooltip" data-bs-title="Edit" style="width: max-content;">
                                            <button type="button" class="btn btn-outline-warning d-inline-flex p-1"><i
                                                    class="ti ti-pencil"></i></button>
                                        </a>
                                        <div data-bs-toggle="tooltip" data-bs-title="Reset password" style="width: max-content;">
                                            <button type="button" class="btn btn-outline-secondary d-inline-flex p-1"
                                                data-bs-toggle="modal" data-bs-target="#modalResetPassword" data-context="users"
                                                data-id="<?= $user['id'] ?>"><i class="ti ti-rotate-clockwise-2"></i></button>
                                        </div>
                                        <div data-bs-toggle="tooltip" data-bs-title="Hapus" style="width: max-content;">
                                            <button type="button" class="btn btn-outline-danger d-inline-flex p-1"
                                                data-bs-toggle="modal" data-bs-target="#modalHapus" data-context="users"
                                                data-id="<?= $user['id'] ?>"><i class="ti ti-trash"></i></button>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>