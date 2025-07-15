<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="ti ti-box"></i> Detail Metode Pembayaram</h3>
                    <span>Informasi Detail Metode Pembayaram</span>
                </div>
                <div>
                    <a href="<?= base_url('/admin/payment-methods') ?>" class="btn btn-secondary">
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
                                <?php if (!empty($payment_method['path_foto'])): ?>
                                    <img src="<?= base_url('assets/images/payment-methods/' . $payment_method['path_foto']) ?>"
                                        alt="<?= $payment_method['label'] ?>" class="img-fluid"
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
                                    <th>Kode</th>
                                    <td><?= $payment_method['kode'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Label</th>
                                    <td><?= $payment_method['label'] ?? '-' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4"> <a href="<?= base_url('/admin/payment-methods/form/' . $payment_method['id']); ?>"
                            class="btn btn-warning me-2">
                            <span class="d-flex align-items-center gap-1">
                                <i class="ti ti-pencil"></i>
                                Edit
                            </span>
                        </a> <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalHapus" data-context="payment-methods"
                            data-id="<?= $payment_method['id'] ?>">
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