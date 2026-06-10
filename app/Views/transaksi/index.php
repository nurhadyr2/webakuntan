<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <input type="text" id="search" class="form-control" style="max-width:280px" placeholder="Cari invoice...">
    <a class="btn btn-gold ms-auto" href="<?= base_url('transaksi/baru') ?>"><i class="fa-solid fa-plus me-1"></i> Transaksi Baru</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>Invoice</th><th>Tanggal</th><th class="text-end">Total</th><th class="text-end">Bayar</th><th class="text-end">Kembalian</th><th class="text-end" style="width:100px">Aksi</th></tr>
            </thead>
            <tbody id="tbody">
                <?php if (empty($transaksi)): ?>
                    <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada transaksi.</td></tr>
                <?php else: foreach ($transaksi as $t): ?>
                    <tr>
                        <td><strong style="color:var(--navy)"><?= esc($t['invoice']) ?></strong></td>
                        <td><?= date('d M Y H:i', strtotime($t['tgl_trans'])) ?></td>
                        <td class="text-end">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($t['bayar'], 0, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($t['kembalian'], 0, ',', '.') ?></td>
                        <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="<?= base_url('transaksi/struk/' . $t['id_trans']) ?>"><i class="fa-solid fa-receipt me-1"></i>Struk</a></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
document.getElementById('search').addEventListener('keyup', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tbody tr').forEach(tr => tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none');
});
</script>
<?= $this->endSection() ?>
