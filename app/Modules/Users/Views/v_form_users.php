<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="ti ti-user"></i> <?= isset($user) ? 'Edit' : 'Tambah' ?> User</h3>
                    <span>Form <?= isset($user) ? 'Edit' : 'Tambah' ?> Data User</span>
                </div>
                <div>
                    <a href="<?= base_url('/admin/users') ?>" class="btn btn-secondary">
                        <span class="d-flex gap-1 align-items-center">
                            <i class="ti ti-arrow-left"></i>
                            Kembali
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/admin/users/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (isset($user)) : ?>
                    <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                                id="username" name="username" value="<?= old('username', $user['username'] ?? '') ?>" placeholder="Masukkan username...">
                            <?php if (session('errors.username')) : ?>
                                <div class="invalid-feedback"><?= session('errors.username') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="nama">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                                id="nama" name="nama" value="<?= old('nama', $user['nama'] ?? '') ?>" placeholder="Masukkan nama...">
                            <?php if (session('errors.nama')) : ?>
                                <div class="invalid-feedback"><?= session('errors.nama') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                                id="email" name="email" value="<?= old('email', $user['email'] ?? '') ?>" placeholder="Masukkan email...">
                            <?php if (session('errors.email')) : ?>
                                <div class="invalid-feedback"><?= session('errors.email') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-select <?= session('errors.status') ? 'is-invalid' : '' ?>"
                                id="status" name="status">
                                <option value="" selected disabled>-- Pilih Status --</option>
                                <option value="1" <?= (old('status', $user['status'] ?? '')) == '1' ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= (old('status', $user['status'] ?? '')) == '0' ? 'selected' : '' ?>>Non-aktif</option>
                            </select>
                            <?php if (session('errors.status')) : ?>
                                <div class="invalid-feedback"><?= session('errors.status') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="is_admin">Admin Sistem</label>
                            <select class="form-select <?= session('errors.is_admin') ? 'is-invalid' : '' ?>"
                                id="is_admin" name="is_admin">
                                <option value="0" <?= (old('is_admin', $user['is_admin'] ?? '') == '0') ? 'selected' : '' ?>>Tidak</option>
                                <option value="1" <?= (old('is_admin', $user['is_admin'] ?? '') == '1') ? 'selected' : '' ?>>Ya</option>
                            </select>
                            <?php if (session('errors.is_admin')) : ?>
                                <div class="invalid-feedback"><?= session('errors.is_admin') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (!isset($user)) { ?>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                                    id="password" name="password" value="<?= old('password', $user['password'] ?? '') ?>" placeholder="Masukkan password...">
                                <?php if (session('errors.password')) : ?>
                                    <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="foto">Foto User</label>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex flex-column">
                                        <div class="image-preview mb-3 text-center" style="min-height: 200px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                            <?php if (isset($user) && !empty($user['path_foto'])) : ?>
                                                <img src="/assets/images/pengguna/<?= $user['path_foto'] ?>" alt="Preview" id="imagePreview" class="img-fluid" style="max-height: 200px;">
                                            <?php else : ?>
                                                <div class="text-center" id="noImagePreview">
                                                    <i class="ti ti-photo text-muted" style="font-size: 5rem;"></i>
                                                    <p class="text-muted">Tidak ada foto</p>
                                                </div>
                                                <img src="" alt="Preview" id="imagePreview" class="img-fluid d-none" style="max-height: 200px;">
                                            <?php endif; ?>
                                        </div>
                                        <input type="file" class="form-control <?= session('errors.path_foto') ? 'is-invalid' : '' ?>"
                                            id="foto" name="path_foto" accept="image/*">
                                        <small class="text-muted mt-1">Format: JPG, PNG, GIF. Maks 2MB</small>
                                        <?php if (session('errors.path_foto')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.path_foto') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <span class="d-flex align-items-center gap-1">
                            <i class="ti ti-device-floppy"></i>
                            Simpan
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>