<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <input type="text" id="search" class="form-control" style="max-width:280px" placeholder="Cari kode / nama akun...">
    <button class="btn btn-gold ms-auto" data-bs-toggle="modal" data-bs-target="#modal" onclick="openModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Akun</button>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th style="width:120px">Kode Akun</th><th>Nama Akun</th><th style="width:120px">Posisi</th><th class="text-end" style="width:160px">Aksi</th></tr>
            </thead>
            <tbody id="tbody">
                <?php if (empty($akun)): ?>
                    <tr><td colspan="4" class="text-center text-secondary py-4">Belum ada data akun.</td></tr>
                <?php else: foreach ($akun as $a): ?>
                    <tr>
                        <td><strong><?= esc($a['kode_akun']) ?></strong></td>
                        <td><?= esc($a['nama_akun']) ?></td>
                        <td><span class="badge badge-<?= $a['posisi'] ?>"><?= ucfirst($a['posisi']) ?></span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal"
                                onclick="openEdit(<?= $a['id_akun'] ?>, '<?= esc($a['kode_akun'], 'js') ?>', '<?= esc($a['nama_akun'], 'js') ?>', '<?= $a['posisi'] ?>')"><i class="fa-solid fa-pen me-1"></i>Edit</button>
                            <a class="btn btn-sm btn-danger" href="<?= base_url('akun/hapus/' . $a['id_akun']) ?>" onclick="return confirm('Hapus akun ini?')"><i class="fa-solid fa-trash me-1"></i>Hapus</a>
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
                    <h5 class="modal-title" id="modalTitle">Tambah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Kode Akun</label>
                            <input type="text" name="kode_akun" id="kode_akun" class="form-control" placeholder="cth: 111" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Posisi Normal</label>
                            <select name="posisi" id="posisi" class="form-select" required>
                                <option value="debit">Debit</option>
                                <option value="kredit">Kredit</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nama Akun</label>
                            <input type="text" name="nama_akun" id="nama_akun" class="form-control" required>
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
    document.getElementById('modalTitle').textContent = 'Tambah Akun';
    form.reset();
    form.action = base + 'akun/simpan';
}
function openEdit(id, kode, nama, posisi) {
    document.getElementById('modalTitle').textContent = 'Edit Akun';
    document.getElementById('kode_akun').value = kode;
    document.getElementById('nama_akun').value = nama;
    document.getElementById('posisi').value = posisi;
    form.action = base + 'akun/update/' + id;
}
document.getElementById('search').addEventListener('keyup', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tbody tr').forEach(tr => tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none');
});
</script>
<?= $this->endSection() ?>
