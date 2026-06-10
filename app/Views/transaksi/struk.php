<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="mx-auto" style="max-width:520px">
    <div class="card" id="struk">
        <div class="card-body text-center border-bottom" style="border-style:dashed!important">
            <div class="login-logo mx-auto mb-2" style="width:48px;height:48px;font-size:20px">SP</div>
            <h2 class="h5 mb-0">Sistem Penjualan</h2>
            <div class="text-secondary small">Struk Pembelian</div>
        </div>
        <div class="card-body border-bottom small" style="border-style:dashed!important">
            <div class="d-flex justify-content-between"><span>Invoice</span><strong><?= esc($trx['invoice']) ?></strong></div>
            <div class="d-flex justify-content-between mt-1"><span>Tanggal</span><span><?= date('d M Y H:i', strtotime($trx['tgl_trans'])) ?></span></div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless mb-0 small">
                <?php foreach ($detail as $d): ?>
                <tr>
                    <td class="px-0"><?= esc($d['nama_produk']) ?><br>
                        <span class="text-secondary"><?= $d['qty'] ?> × Rp <?= number_format($d['harga'], 0, ',', '.') ?></span></td>
                    <td class="px-0 text-end">Rp <?= number_format($d['sub_total'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card-body border-top" style="border-style:dashed!important">
            <div class="d-flex justify-content-between mb-1"><span>Total</span><strong class="fs-6 highlight-gold">Rp <?= number_format($trx['total'], 0, ',', '.') ?></strong></div>
            <div class="d-flex justify-content-between small text-secondary"><span>Bayar</span><span>Rp <?= number_format($trx['bayar'], 0, ',', '.') ?></span></div>
            <div class="d-flex justify-content-between small text-secondary"><span>Kembalian</span><span>Rp <?= number_format($trx['kembalian'], 0, ',', '.') ?></span></div>
        </div>
        <div class="card-body text-center text-secondary small border-top" style="border-style:dashed!important">
            Terima kasih atas kunjungan Anda 🙏
        </div>
    </div>

    <div class="d-flex justify-content-center gap-2 mt-3">
        <a class="btn btn-outline-secondary" href="<?= base_url('transaksi') ?>">← Kembali</a>
        <a class="btn btn-navy" href="<?= base_url('transaksi/baru') ?>"><i class="fa-solid fa-plus me-1"></i> Transaksi Baru</a>
        <button class="btn btn-gold" onclick="window.print()"><i class="fa-solid fa-print me-1"></i> Cetak</button>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('head') ?>
<style>
@media print {
    .sidebar, .topbar, .d-flex.justify-content-center { display: none !important; }
    .main { margin-left: 0 !important; width: 100% !important; }
    .content { padding: 0 !important; }
    body { background: #fff; }
}
</style>
<?= $this->endSection() ?>
