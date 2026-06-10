<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('laporan-penjualan') ?>" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= esc($dari) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= esc($sampai) ?>">
            </div>
            <div class="col-md-4">
                <button class="btn btn-gold" type="submit">Proses</button>
                <a class="btn btn-navy" target="_blank" href="<?= base_url('laporan-penjualan/cetak?dari=' . $dari . '&sampai=' . $sampai) ?>"><i class="fa-solid fa-print me-1"></i> Cetak PDF</a>
            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6"><div class="card"><div class="card-body">
        <div class="text-secondary small">Jumlah Transaksi</div>
        <div class="fs-4 fw-bold" style="color:var(--navy)"><?= count($data) ?></div>
    </div></div></div>
    <div class="col-md-6"><div class="card"><div class="card-body">
        <div class="text-secondary small">Total Penjualan</div>
        <div class="fs-4 highlight-gold">Rp <?= number_format($total, 0, ',', '.') ?></div>
    </div></div></div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr><th>No</th><th>Invoice</th><th>Tanggal</th><th class="text-end">Total</th></tr></thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr><td colspan="4" class="text-center text-secondary py-4">Tidak ada penjualan pada periode ini.</td></tr>
                <?php else: foreach ($data as $i => $t): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><strong style="color:var(--navy)"><?= esc($t['invoice']) ?></strong></td>
                        <td><?= date('d M Y H:i', strtotime($t['tgl_trans'])) ?></td>
                        <td class="text-end">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
            <?php if (! empty($data)): ?>
            <tfoot>
                <tr class="fw-bold" style="background:#f8f1dd">
                    <td colspan="3" class="text-end">TOTAL</td>
                    <td class="text-end highlight-gold">Rp <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
