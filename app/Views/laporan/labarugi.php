<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('laporan-labarugi') ?>" class="row g-2 align-items-end">
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
                <a class="btn btn-navy" target="_blank" href="<?= base_url('laporan-labarugi/cetak?dari=' . $dari . '&sampai=' . $sampai) ?>"><i class="fa-solid fa-print me-1"></i> Cetak PDF</a>
            </div>
        </form>
    </div>
</div>

<div style="max-width:640px">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Laporan Laba Rugi</span>
            <span class="text-secondary small"><?= date('d M Y', strtotime($dari)) ?> &ndash; <?= date('d M Y', strtotime($sampai)) ?></span>
        </div>
        <div class="card-body">
            <h6 class="text-success">Pendapatan</h6>
            <table class="table table-sm align-middle">
                <tbody>
                <?php foreach ($pendapatan as $p): ?>
                    <tr><td><?= esc($p['akun']['kode_akun']) ?> &ndash; <?= esc($p['akun']['nama_akun']) ?></td>
                        <td class="text-end">Rp <?= number_format($p['jumlah'], 0, ',', '.') ?></td></tr>
                <?php endforeach; ?>
                <?php if (empty($pendapatan)): ?><tr><td colspan="2" class="text-secondary">Tidak ada pendapatan.</td></tr><?php endif; ?>
                <tr class="fw-bold" style="background:#f5fbf7"><td>Total Pendapatan</td><td class="text-end">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></td></tr>
                </tbody>
            </table>

            <h6 class="text-danger mt-4">Beban</h6>
            <table class="table table-sm align-middle">
                <tbody>
                <?php foreach ($beban as $b): ?>
                    <tr><td><?= esc($b['akun']['kode_akun']) ?> &ndash; <?= esc($b['akun']['nama_akun']) ?></td>
                        <td class="text-end">Rp <?= number_format($b['jumlah'], 0, ',', '.') ?></td></tr>
                <?php endforeach; ?>
                <?php if (empty($beban)): ?><tr><td colspan="2" class="text-secondary">Tidak ada beban.</td></tr><?php endif; ?>
                <tr class="fw-bold" style="background:#fdf5f5"><td>Total Beban</td><td class="text-end">Rp <?= number_format($totalBeban, 0, ',', '.') ?></td></tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3 p-3 rounded bg-navy text-white">
                <strong>LABA BERSIH</strong>
                <strong class="fs-5" style="color:var(--gold-soft)">Rp <?= number_format($labaBersih, 0, ',', '.') ?></strong>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
