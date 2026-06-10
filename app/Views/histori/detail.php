<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div style="max-width:640px">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Invoice <?= esc($trx['invoice']) ?></span>
            <span class="text-secondary small"><?= date('d M Y H:i', strtotime($trx['tgl_trans'])) ?></span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr><th>Produk</th><th class="text-end">Harga</th><th class="text-center">Qty</th><th class="text-end">Subtotal</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail as $d): ?>
                        <tr>
                            <td><?= esc($d['nama_produk']) ?></td>
                            <td class="text-end">Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                            <td class="text-center"><?= $d['qty'] ?></td>
                            <td class="text-end">Rp <?= number_format($d['sub_total'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="border-top pt-3">
                <div class="d-flex justify-content-between mb-1"><span>Total</span><strong class="fs-6 highlight-gold">Rp <?= number_format($trx['total'], 0, ',', '.') ?></strong></div>
                <div class="d-flex justify-content-between small text-secondary"><span>Bayar</span><span>Rp <?= number_format($trx['bayar'], 0, ',', '.') ?></span></div>
                <div class="d-flex justify-content-between small text-secondary"><span>Kembalian</span><span>Rp <?= number_format($trx['kembalian'], 0, ',', '.') ?></span></div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2 mt-3">
        <a class="btn btn-outline-secondary" href="<?= base_url('histori') ?>">← Kembali</a>
        <a class="btn btn-gold" href="<?= base_url('transaksi/struk/' . $trx['id_trans']) ?>"><i class="fa-solid fa-receipt me-1"></i> Lihat Struk</a>
    </div>
</div>

<?= $this->endSection() ?>
