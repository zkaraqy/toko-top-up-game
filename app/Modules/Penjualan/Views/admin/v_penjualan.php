<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h3><i class="ti ti-users"></i> Penjualan</h3>
                    <span>Kelola Data Penjualan</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-6 col-12">
                <form method="GET" action="<?= base_url('/admin/sales/search') ?>" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control"
                            placeholder="Cari..."
                            value="<?= $q ?? '' ?>">
                        <button class="btn btn-outline-secondary d-flex align-items-center" type="submit">
                            <i class="ti ti-search"></i>
                        </button>
                        <?php if (!empty($q)): ?>
                            <a href="<?= base_url('/admin/sales') ?>"
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
                            <th class="text-center">User</th>
                            <th>Game</th>
                            <th>Metode Pembayaran</th>
                            <th>Harga (qty)</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($sales)): ?>
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
                            <?php foreach ($sales as $sale) { ?>
                                <tr id="<?= $sale['id'] ?>">
                                    <td class="text-center"><?php echo $no;
                                                            ++$no; ?></td>
                                    <td>
                                        <a href="<?= site_url('/admin/users/detail/' . $sale['id_pengguna']) ?>" class="link-primary">
                                            <?= $sale['nama_pengguna'] ?? '-' ?> (<?= $sale['username_pengguna'] ?? '-'?>)
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('/admin/games/detail/' . ($sale['id_game'] ?? '-')) ?>" class="link-primary">
                                            <?= $sale['nama_game'] ?? '-'?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('/admin/payment-methods/detail/' . ($sale['metode_pembayaran_id'] ?? '-')) ?>" class="link-primary">
                                            <?= $sale['metode_pembayaran_label'] ?? '-' ?> (<?= $sale['metode_pembayaran_kode'] ?? '-' ?>)
                                        </a>
                                    </td>
                                    <td>
                                        Rp <?= number_format($sale['price'], 0, ',', '.') ?> (<i class="ti ti-diamond text-primary"></i> <?= $sale['qty'] ?? '-' ?>)
                                    </td>
                                    <td>
                                        <?= date('d/m/Y H:i', strtotime($sale['created_at'])) ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-column">
                                            <div data-bs-toggle="tooltip" data-bs-title="Hapus" style="width: max-content;">
                                                <button type="button" class="btn btn-outline-danger d-inline-flex p-1"
                                                    data-bs-toggle="modal" data-bs-target="#modalHapus" data-context="penjualan"
                                                    data-id="<?= $sale['id'] ?>"><i class="ti ti-trash"></i></button>
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
    .link-primary {
        color: #1890ff !important;
        transition: all .5s ease-in-out;
    }

    .link-primary:hover {
        text-decoration: underline #1890ff !important;
    }

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