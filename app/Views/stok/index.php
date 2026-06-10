<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <input type="text" id="search" class="form-control" style="max-width:280px" placeholder="Cari produk / kategori...">
    <button class="btn btn-gold ms-auto" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-plus me-1"></i> Tambah Stok Masuk</button>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th style="width:60px">#</th><th>Produk</th><th>Kategori</th><th class="text-center">Jumlah Masuk</th><th>Tanggal</th><th class="text-end" style="width:100px">Aksi</th></tr>
            </thead>
            <tbody id="tbody">
                <?php if (empty($stok)): ?>
                    <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada catatan stok masuk.</td></tr>
                <?php else: foreach ($stok as $i => $s): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><strong><?= esc($s['nama_produk'] ?? '-') ?></strong></td>
                        <td><span class="badge text-bg-light border"><?= esc($s['nama_kategori'] ?? '-') ?></span></td>
                        <td class="text-center"><span class="badge text-bg-success">+<?= $s['jml_stok'] ?></span></td>
                        <td><?= $s['created_at'] ? date('d M Y H:i', strtotime($s['created_at'])) : '-' ?></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-danger" href="<?= base_url('stok/hapus/' . $s['id_stok']) ?>" onclick="return confirm('Hapus catatan ini? Stok produk akan dikurangi.')"><i class="fa-solid fa-trash me-1"></i>Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('stok/simpan') ?>">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Stok Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Produk</label>
                        <select name="id_barang" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach ($produk as $p): ?>
                                <option value="<?= $p['id_produk'] ?>"><?= esc($p['nama_produk']) ?> (stok: <?= $p['stok'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah Masuk</label>
                        <input type="number" name="jml_stok" class="form-control" min="1" value="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gold">Simpan</button>
                </div>
            </form>
        </div>
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
