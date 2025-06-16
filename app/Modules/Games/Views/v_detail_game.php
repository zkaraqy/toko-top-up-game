<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><i class="ti ti-box"></i> Detail Game</h3>
                    <span>Informasi Detail Game</span>
                </div>
                <div>
                    <a href="<?= base_url('/admin/games') ?>" class="btn btn-secondary">
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
                                <?php if (!empty($game['path_foto'])): ?>
                                    <img src="/assets/images/games/<?= $game['path_foto'] ?>"
                                        alt="<?= $game['title'] ?>" class="img-fluid"
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
                                    <th>Judul</th>
                                    <td><?= $game['title'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Developer</th>
                                    <td><?= $game['developer'] ?? '-' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="<?= base_url('/admin/games/form/' . $game['id']); ?>"
                            class="btn btn-warning me-2">
                            <span class="d-flex align-items-center gap-1">
                                <i class="ti ti-pencil"></i>
                                Edit
                            </span>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalHapus" data-context="games"
                            data-id="<?= $game['id'] ?>">
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
    <div class="mt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5><i class="ti ti-diamond"></i> Top-Up Options</h5>
                        <span>Daftar pilihan top-up untuk game ini</span>
                    </div>
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
                                            <h6 class="mb-2">Rp <?= number_format($option['price'], 0, ',', '.') ?></h6>
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
</div>