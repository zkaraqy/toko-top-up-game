<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="ti ti-device-gamepad"></i> <?= isset($game) ? 'Edit' : 'Tambah' ?> Game</h3>
                    <span>Form <?= isset($game) ? 'Edit' : 'Tambah' ?> Data Game</span>
                </div>
                <div>
                    <a href="<?= base_url('/admin/games') ?>" class="btn btn-secondary">
                        <span class="d-flex gap-1 align-items-center">
                            <i class="ti ti-arrow-left"></i>
                            Kembali
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="<?= base_url('/admin/games/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (isset($game)) : ?>
                    <input type="hidden" name="id" value="<?= $game['id'] ?? '' ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="title">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.title') ? 'is-invalid' : '' ?>"
                                id="title" name="title" value="<?= old('title', $game['title'] ?? '') ?>" placeholder="Masukkan judul...">
                            <?php if (session('errors.title')) : ?>
                                <div class="invalid-feedback"><?= session('errors.title') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="developer">Nama Developer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.developer') ? 'is-invalid' : '' ?>"
                                id="developer" name="developer" value="<?= old('developer', $game['developer'] ?? '') ?>" placeholder="Masukkan developer...">
                            <?php if (session('errors.developer')) : ?>
                                <div class="invalid-feedback"><?= session('errors.developer') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="foto">Foto Game</label>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex flex-column">
                                        <div class="image-preview mb-3 text-center" style="min-height: 200px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                            <?php if (isset($game) && !empty($game['path_foto'])) : ?>
                                                <img src="/assets/images/games/<?= $game['path_foto'] ?>" alt="Preview" id="imagePreview" class="img-fluid" style="max-height: 200px;">
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

            <?php if (isset($game)) : ?>
                <div class="mt-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5><i class="ti ti-diamond"></i> Top-Up Options</h5>
                                    <span>Kelola pilihan top-up</span>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTopUpModal">
                                    <i class="ti ti-plus"></i> Tambah Option
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="topUpOptionsContainer">
                                <?php if (!empty($topUpOptions)) : ?>
                                    <div class="row" id="topUpGrid">
                                        <?php foreach ($topUpOptions as $option) : ?>
                                            <div class="col-md-3 mb-3" data-option-id="<?= $option['id'] ?>">
                                                <div class="card border">
                                                    <div class="card-body text-center p-3">
                                                        <?php if (!empty($option['path_foto'])) : ?>
                                                            <img src="/assets/images/topup/<?= $option['path_foto'] ?>" alt="Diamond" class="img-fluid mb-2" style="max-height: 80px;">
                                                        <?php else : ?>
                                                            <i class="ti ti-diamond text-primary" style="font-size: 3rem;"></i>
                                                        <?php endif; ?>
                                                        <h6 class="mb-2">Rp <?= number_format($option['price'], 0, ',', '.') ?> (<?= $option['qty'] ?>)</h6>
                                                        <div class="d-flex gap-1 justify-content-center">
                                                            <button type="button" class="btn btn-outline-warning btn-sm" onclick="editTopUpOption(<?= $option['id'] ?>, <?= $option['qty'] ?>, '<?= $option['price'] ?>', '<?= $option['path_foto'] ?>')">
                                                                <i class="ti ti-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteTopUpOption(<?= $option['id'] ?>)">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="text-center py-4" id="noTopUpOptions">
                                        <i class="ti ti-diamond text-muted" style="font-size: 4rem;"></i>
                                        <p class="text-muted">Belum ada top-up option untuk game ini</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Add/Edit Top-Up Option -->
<?php if (isset($game)) : ?>
    <div class="modal fade" id="addTopUpModal" tabindex="-1" aria-labelledby="addTopUpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTopUpModalLabel">
                        <i class="ti ti-diamond"></i> <span id="modalTitle">Tambah Top-Up Option</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="topUpForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="optionId" name="option_id">
                        <input type="hidden" name="game_id" value="<?= $game['id'] ?>">

                        <div class="mb-3">
                            <label for="qty" class="form-label">Kuantitas <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="qty" name="qty" placeholder="Masukkan kuantitas..." required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga..." required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="topup_foto" class="form-label">Foto (Opsional)</label>
                            <input type="file" class="form-control" id="topup_foto" name="path_foto" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks 2MB</small>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div id="currentImagePreview" class="text-center mb-3" style="display: none;">
                            <label class="form-label">Preview:</label>
                            <br>
                            <img id="currentImage" src="" alt="Current" class="img-fluid" style="max-height: 100px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveTopUpBtn">
                            <i class="ti ti-device-floppy"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    document.getElementById('foto')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const noPreview = document.getElementById('noImagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (noPreview) {
                    noPreview.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });

    <?php if (isset($game)) : ?>
        let editingOptionId = null;

        function resetTopUpModal() {
            document.getElementById('topUpForm').reset();
            document.getElementById('optionId').value = '';
            document.getElementById('modalTitle').textContent = 'Tambah Top-Up Option';
            document.getElementById('currentImagePreview').style.display = 'none';

            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

            editingOptionId = null;
        }

        function editTopUpOption(id, qty, price, pathFoto) {
            editingOptionId = id;
            document.getElementById('optionId').value = id;
            document.getElementById('qty').value = qty;
            document.getElementById('price').value = price;
            document.getElementById('modalTitle').textContent = 'Edit Top-Up Option';

            if (pathFoto && pathFoto !== '') {
                document.getElementById('currentImagePreview').style.display = 'block';
                document.getElementById('currentImage').src = '/assets/images/topup/' + pathFoto;
            }

            new bootstrap.Modal(document.getElementById('addTopUpModal')).show();
        }

        function deleteTopUpOption(id) {
            if (confirm('Apakah Anda yakin ingin menghapus top-up option ini?')) {
                fetch(`<?= base_url('/admin/games/topup/delete/') ?>${id}`, {
                        method: 'DELETE',
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`[data-option-id="${id}"]`).remove();

                            const remaining = document.querySelectorAll('[data-option-id]');
                            if (remaining.length === 0) {
                                document.getElementById('topUpOptionsContainer').innerHTML = `
                        <div class="text-center py-4" id="noTopUpOptions">
                            <i class="ti ti-diamond text-muted" style="font-size: 4rem;"></i>
                            <p class="text-muted">Belum ada top-up option untuk game ini</p>
                        </div>
                    `;
                            }
                            alert('Top-up option berhasil dihapus!');
                        } else {
                            alert('Gagal menghapus top-up option: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus top-up option');
                    });
            }
        }

        document.getElementById('topUpForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const url = editingOptionId ?
                `<?= base_url('/admin/games/topup/update/') ?>${editingOptionId}` :
                '<?= base_url('/admin/games/topup/save') ?>';

            fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('addTopUpModal')).hide();

                        location.reload();
                    } else {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const input = document.getElementById(field);
                                const errorDiv = document.getElementById(field + 'Error');

                                if (input && errorDiv) {
                                    input.classList.add('is-invalid');
                                    errorDiv.textContent = data.errors[field];
                                }
                            });
                        } else {
                            alert('Gagal menyimpan: ' + data.message);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                });
        });

        document.getElementById('addTopUpModal').addEventListener('hidden.bs.modal', resetTopUpModal);
    <?php endif; ?>
</script>