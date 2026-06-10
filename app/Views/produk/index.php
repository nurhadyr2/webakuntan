<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <input type="text" id="search" class="form-control" style="max-width:280px" placeholder="Cari produk...">
    <button class="btn btn-gold ms-auto" data-bs-toggle="modal" data-bs-target="#modal" onclick="openModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Produk</button>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th style="width:60px">#</th><th>Nama Produk</th><th>Kategori</th><th class="text-end">Harga</th><th class="text-center">Stok</th><th class="text-end" style="width:160px">Aksi</th></tr>
            </thead>
            <tbody id="tbody">
                <?php if (empty($produk)): ?>
                    <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada data produk.</td></tr>
                <?php else: foreach ($produk as $i => $p): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><strong><?= esc($p['nama_produk']) ?></strong></td>
                        <td><span class="badge text-bg-light border"><?= esc($p['nama_kategori'] ?? '-') ?></span></td>
                        <td class="text-end">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                        <td class="text-center"><span class="badge <?= $p['stok'] <= 5 ? 'text-bg-warning' : 'text-bg-success' ?>"><?= $p['stok'] ?></span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal"
                                onclick="openEdit(<?= $p['id_produk'] ?>, <?= $p['id_kategori'] ?>, '<?= esc($p['nama_produk'], 'js') ?>', '<?= $p['harga'] ?>', <?= $p['stok'] ?>)"><i class="fa-solid fa-pen me-1"></i>Edit</button>
                            <a class="btn btn-sm btn-danger" href="<?= base_url('produk/hapus/' . $p['id_produk']) ?>" onclick="return confirm('Hapus produk ini?')"><i class="fa-solid fa-trash me-1"></i>Hapus</a>
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
            <form id="modalForm" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>"><?= esc($k['nama_kategori']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" name="harga" id="harga" class="form-control" min="0" step="0.01" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Stok Awal</label>
                            <input type="number" name="stok" id="stok" class="form-control" min="0" value="0">
                        </div>
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
const base = '<?= base_url() ?>';
const form = document.getElementById('modalForm');
function openModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Produk';
    form.reset();
    document.getElementById('stok').value = 0;
    form.action = base + 'produk/simpan';
}
function openEdit(id, idKat, nama, harga, stok) {
    document.getElementById('modalTitle').textContent = 'Edit Produk';
    document.getElementById('nama_produk').value = nama;
    document.getElementById('id_kategori').value = idKat;
    document.getElementById('harga').value = harga;
    document.getElementById('stok').value = stok;
    form.action = base + 'produk/update/' + id;
}
document.getElementById('search').addEventListener('keyup', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tbody tr').forEach(tr => tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none');
});
</script>
<?= $this->endSection() ?>
