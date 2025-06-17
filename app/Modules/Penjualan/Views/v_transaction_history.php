<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-history"></i> Riwayat Transaksi</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($transactions)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="bg-info">
                                    <tr>
                                        <th class="text-light">ID Transaksi</th>
                                        <th class="text-light">Player ID</th>
                                        <th class="text-light">Server</th>
                                        <th class="text-light">Total</th>
                                        <th class="text-light">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $transaction): ?>
                                        <tr>
                                            <td>#<?= $transaction['id'] ?></td>
                                            <td><?= $transaction['player_id'] ?></td>
                                            <td><?= $transaction['player_server'] ?></td>
                                            <td>Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($transaction['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada transaksi</h5>
                            <p class="text-muted">Anda belum memiliki riwayat transaksi.</p>
                            <a href="<?= base_url('/top-up/games') ?>" class="btn btn-primary">
                                <i class="fas fa-gamepad me-2"></i>Mulai Top-Up
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
