<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <input type="text" id="search" class="form-control" style="max-width:280px" placeholder="Cari kategori...">
    <button class="btn btn-gold ms-auto" data-bs-toggle="modal" data-bs-target="#modal" onclick="openModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Kategori</button>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th style="width:80px">#</th><th>Nama Kategori</th><th class="text-end" style="width:160px">Aksi</th></tr>
            </thead>
            <tbody id="tbody">
                <?php if (empty($kategori)): ?>
                    <tr><td colspan="3" class="text-center text-secondary py-4">Belum ada data kategori.</td></tr>
                <?php else: foreach ($kategori as $i => $k): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($k['nama_kategori']) ?></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal"
                                onclick="openEdit(<?= $k['id_kategori'] ?>, '<?= esc($k['nama_kategori'], 'js') ?>')"><i class="fa-solid fa-pen me-1"></i>Edit</button>
                            <a class="btn btn-sm btn-danger" href="<?= base_url('kategori/hapus/' . $k['id_kategori']) ?>" onclick="return confirm('Hapus kategori ini?')"><i class="fa-solid fa-trash me-1"></i>Hapus</a>
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
                    <h5 class="modal-title" id="modalTitle">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
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
    document.getElementById('modalTitle').textContent = 'Tambah Kategori';
    document.getElementById('nama_kategori').value = '';
    form.action = base + 'kategori/simpan';
}
function openEdit(id, nama) {
    document.getElementById('modalTitle').textContent = 'Edit Kategori';
    document.getElementById('nama_kategori').value = nama;
    form.action = base + 'kategori/update/' + id;
}
document.getElementById('search').addEventListener('keyup', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tbody tr').forEach(tr => tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none');
});
</script>
<?= $this->endSection() ?>
