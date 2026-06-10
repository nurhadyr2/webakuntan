<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('bukubesar') ?>" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label fw-semibold">Pilih Akun</label>
                <select name="id_akun" class="form-select" required>
                    <option value="">-- Pilih Akun --</option>
                    <?php foreach ($akunList as $a): ?>
                        <option value="<?= $a['id_akun'] ?>" <?= $idAkun == $a['id_akun'] ? 'selected' : '' ?>>
                            <?= esc($a['kode_akun']) ?> &ndash; <?= esc($a['nama_akun']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= esc($dari) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= esc($sampai) ?>">
            </div>
            <div class="col-md-1">
                <button class="btn btn-gold w-100" type="submit">Proses</button>
            </div>
        </form>
    </div>
</div>

<?php if ($akun): ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <strong style="color:var(--navy)"><?= esc($akun['kode_akun']) ?> &ndash; <?= esc($akun['nama_akun']) ?></strong>
            <span class="badge badge-<?= $akun['posisi'] ?> ms-2">Posisi Normal: <?= ucfirst($akun['posisi']) ?></span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:110px">Tanggal</th><th style="width:110px">Referensi</th><th>Keterangan</th>
                    <th class="text-end">Debit (Rp)</th><th class="text-end">Kredit (Rp)</th><th class="text-end">Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-light fw-semibold">
                    <td colspan="5">SALDO AWAL (Membawa)</td>
                    <td class="text-end"><?= number_format($saldoAwal, 0, ',', '.') ?></td>
                </tr>
                <?php if (empty($mutasi)): ?>
                    <tr><td colspan="6" class="text-center text-secondary py-3">Tidak ada mutasi pada periode ini.</td></tr>
                <?php else: foreach ($mutasi as $m): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($m['tanggal'])) ?></td>
                        <td><?= esc($m['no_jurnal'] ?? '-') ?></td>
                        <td><?= esc($m['keterangan']) ?></td>
                        <td class="text-end"><?= $m['debit'] > 0 ? number_format($m['debit'], 0, ',', '.') : '–' ?></td>
                        <td class="text-end"><?= $m['kredit'] > 0 ? number_format($m['kredit'], 0, ',', '.') : '–' ?></td>
                        <td class="text-end"><strong><?= number_format($m['saldo'], 0, ',', '.') ?></strong></td>
                    </tr>
                <?php endforeach; endif; ?>
                <tr class="table-light fw-semibold">
                    <td colspan="3" class="text-end">TOTAL MUTASI PERIODE INI</td>
                    <td class="text-end"><?= number_format($totalDebit, 0, ',', '.') ?></td>
                    <td class="text-end"><?= number_format($totalKredit, 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="fw-bold" style="background:#f8f1dd">
                    <td colspan="5" class="text-end">SALDO AKHIR</td>
                    <td class="text-end highlight-gold"><?= number_format($saldoAkhir, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php else: ?>
<div class="card"><div class="card-body text-center text-secondary py-4">Pilih akun untuk menampilkan buku besar.</div></div>
<?php endif; ?>

<?= $this->endSection() ?>
