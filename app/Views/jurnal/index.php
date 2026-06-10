<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('jurnal') ?>" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= esc($dari) ?>">
            </div>
            <div class="col-md-5">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= esc($sampai) ?>">
            </div>
            <div class="col-md-2">
                <button class="btn btn-gold w-100" type="submit">Proses</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:110px">Tanggal</th>
                    <th style="width:110px">Referensi</th>
                    <th>Keterangan / Akun</th>
                    <th class="text-end" style="width:150px">Debit (Rp)</th>
                    <th class="text-end" style="width:150px">Kredit (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                    <tr><td colspan="5" class="text-center text-secondary py-4">Tidak ada jurnal pada rentang ini.</td></tr>
                <?php else: foreach ($rows as $row): $h = $row['header']; ?>
                    <tr class="table-light">
                        <td><?= date('d/m/Y', strtotime($h['tanggal'])) ?></td>
                        <td><strong><?= esc($h['no_jurnal']) ?></strong></td>
                        <td colspan="3"><em class="text-primary"><?= esc($h['keterangan']) ?></em></td>
                    </tr>
                    <?php foreach ($row['details'] as $d): ?>
                    <tr>
                        <td></td><td></td>
                        <td style="<?= $d['kredit'] > 0 ? 'padding-left:42px' : 'padding-left:24px' ?>"><?= esc($d['kode_akun']) ?> &ndash; <?= esc($d['nama_akun']) ?></td>
                        <td class="text-end"><?= $d['debit'] > 0 ? number_format($d['debit'], 0, ',', '.') : '–' ?></td>
                        <td class="text-end"><?= $d['kredit'] > 0 ? number_format($d['kredit'], 0, ',', '.') : '–' ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endforeach; endif; ?>
            </tbody>
            <?php if (! empty($rows)): ?>
            <tfoot>
                <tr class="fw-bold" style="background:#f8f1dd">
                    <td colspan="3" class="text-end">TOTAL KESELURUHAN</td>
                    <td class="text-end" style="color:var(--navy)"><?= number_format($totalDebit, 0, ',', '.') ?></td>
                    <td class="text-end" style="color:var(--navy)"><?= number_format($totalKredit, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
