<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="ti ti-credit-card"></i> <?= isset($payment_method) ? 'Edit' : 'Tambah' ?> Metode Pembayaran</h3>
                    <span>Form <?= isset($payment_method) ? 'Edit' : 'Tambah' ?> Data Metode Pembayaran</span>
                </div>
                <div>
                    <a href="<?= base_url('/admin/payment-methods') ?>" class="btn btn-secondary">
                        <span class="d-flex gap-1 align-items-center">
                            <i class="ti ti-arrow-left"></i>
                            Kembali
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/admin/payment-methods/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (isset($payment_method)) : ?>
                    <input type="hidden" name="id" value="<?= $payment_method['id'] ?? '' ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="kode">Kode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.kode') ? 'is-invalid' : '' ?>"
                                id="kode" name="kode" value="<?= old('kode', $payment_method['kode'] ?? '') ?>"
                                placeholder="Masukkan kode...">
                            <?php if (session('errors.kode')) : ?>
                                <div class="invalid-feedback"><?= session('errors.kode') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="label">Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.label') ? 'is-invalid' : '' ?>"
                                id="label" name="label" value="<?= old('label', $payment_method['label'] ?? '') ?>"
                                placeholder="Masukkan label...">
                            <?php if (session('errors.label')) : ?>
                                <div class="invalid-feedback"><?= session('errors.label') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label" for="logo">Logo Metode Pembayaran</label>
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex flex-column">                                        <div class="image-preview mb-3 text-center" style="min-height: 200px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                            <?php if (isset($payment_method) && !empty($payment_method['path_foto'])) : ?>
                                                <img src="<?= base_url('assets/images/payment-methods/' . $payment_method['path_foto']) ?>" alt="Preview" id="imagePreview" class="img-fluid" style="max-height: 200px;">
                                            <?php else : ?>
                                                <div class="text-center" id="noImagePreview">
                                                    <i class="ti ti-photo text-muted" style="font-size: 5rem;"></i>
                                                    <p class="text-muted">Tidak ada foto</p>
                                                </div>
                                                <img src="" alt="Preview" id="imagePreview" class="img-fluid d-none" style="max-height: 200px;">
                                            <?php endif; ?>
                                        </div>
                                        <input type="file" class="form-control <?= session('errors.path_foto') ? 'is-invalid' : '' ?>"
                                            id="logo" name="path_foto" accept="image/*">
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

<script>
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const noPreview = document.getElementById('noImagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (noPreview) noPreview.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
            if (noPreview) noPreview.style.display = 'block';
        }
    });
</script>

<style>
    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn:hover {
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
</style>