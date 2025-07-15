<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="ti ti-box"></i> Detail User</h3>
                    <span>Informasi Detail User</span>
                </div>
                <div>
                    <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary">
                        <span class="d-flex gap-1">
                            <i class="ti ti-arrow-left"></i>
                            Kembali
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="image-container"
                                style="height: 300px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                <?php if (!empty($user['path_foto'])): ?>
                                    <img src="<?= base_url('/assets/images/pengguna/' . $user['path_foto']) ?>"
                                        alt="<?= $user['nama'] ?>" class="img-fluid"
                                        style="max-height: 100%; max-width: 100%;">
                                <?php else: ?>
                                    <div class="text-center">
                                        <i class="ti ti-photo text-muted" style="font-size: 5rem;"></i>
                                        <p class="text-muted">Tidak ada foto</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td><?= $user['nama'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?= $user['username'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $user['email'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-light-<?= (bool) $user['status'] ? 'success' : 'dark' ?>"><?= (bool) $user['status'] ? 'Aktif' : 'Non-aktiif' ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>System Admin</th>
                                    <td>
                                        <span class="badge bg-light-<?= (bool) $user['is_admin'] ? 'success' : 'dark' ?>"><?= (bool) $user['is_admin'] ? 'Ya' : 'Tidak' ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="<?= base_url('/admin/users/form/' . $user['id']); ?>"
                            class="btn btn-warning me-2">
                            <span class="d-flex align-items-center gap-1">
                                <i class="ti ti-pencil"></i>
                                Edit
                            </span>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalHapus" data-context="users"
                            data-id="<?= $user['id'] ?>">
                            <span class="d-flex align-items-center gap-1">
                                <i class="ti ti-trash"></i>
                                Hapus
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>