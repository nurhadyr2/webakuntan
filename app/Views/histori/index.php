<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('histori') ?>" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= esc($dari) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= esc($sampai) ?>">
            </div>
            <div class="col-md-4">
                <button class="btn btn-gold" type="submit">Filter</button>
                <a class="btn btn-light" href="<?= base_url('histori') ?>">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6"><div class="card"><div class="card-body">
        <div class="text-secondary small">Jumlah Transaksi</div>
        <div class="fs-4 fw-bold" style="color:var(--navy)"><?= count($transaksi) ?></div>
    </div></div></div>
    <div class="col-md-6"><div class="card"><div class="card-body">
        <div class="text-secondary small">Total Omzet (sesuai filter)</div>
        <div class="fs-4 highlight-gold">Rp <?= number_format($totalOmzet, 0, ',', '.') ?></div>
    </div></div></div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Invoice</th><th>Tanggal</th><th class="text-end">Total</th><th class="text-end">Bayar</th><th class="text-end">Kembalian</th><th class="text-end" style="width:100px">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($transaksi)): ?>
                    <tr><td colspan="6" class="text-center text-secondary py-4">Tidak ada transaksi pada rentang ini.</td></tr>
                <?php else: foreach ($transaksi as $t): ?>
                    <tr>
                        <td><strong style="color:var(--navy)"><?= esc($t['invoice']) ?></strong></td>
                        <td><?= date('d M Y H:i', strtotime($t['tgl_trans'])) ?></td>
                        <td class="text-end">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($t['bayar'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($t['kembalian'], 0, ',', '.') ?></td>
                        <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="<?= base_url('histori/detail/' . $t['id_trans']) ?>"><i class="fa-solid fa-eye me-1"></i>Detail</a></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
