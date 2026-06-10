<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<form method="post" action="<?= base_url('transaksi/simpan') ?>" id="trxForm">
    <?= csrf_field() ?>
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Detail Barang</div>
                <div class="card-body">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold">Pilih Produk</label>
                            <select id="pilihProduk" class="form-select">
                                <option value="">-- Pilih Produk --</option>
                                <?php foreach ($produk as $p): ?>
                                    <option value="<?= $p['id_produk'] ?>"
                                        data-nama="<?= esc($p['nama_produk'], 'attr') ?>"
                                        data-harga="<?= $p['harga'] ?>" data-stok="<?= $p['stok'] ?>">
                                        <?= esc($p['nama_produk']) ?> — Rp <?= number_format($p['harga'], 0, ',', '.') ?> (stok <?= $p['stok'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Qty</label>
                            <input type="number" id="qtyInput" class="form-control" min="1" value="1">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-navy w-100" onclick="tambahItem()"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle">
                            <thead>
                                <tr><th>Produk</th><th class="text-end">Harga</th><th class="text-center">Qty</th><th class="text-end">Subtotal</th><th style="width:50px"></th></tr>
                            </thead>
                            <tbody id="cart">
                                <tr id="emptyRow"><td colspan="5" class="text-center text-secondary py-3">Belum ada barang.</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Pembayaran</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. Invoice</label>
                        <input type="text" class="form-control" value="<?= esc($invoice) ?>" readonly>
                        <div class="form-text">*Nomor final dibuat saat menyimpan.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="text" class="form-control" value="<?= date('d M Y H:i') ?>" readonly>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Total</span>
                        <strong id="totalText" class="fs-5" style="color:var(--navy)">Rp 0</strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bayar (Rp)</label>
                        <input type="number" name="bayar" id="bayar" class="form-control" min="0" oninput="hitungKembalian()" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Kembalian</span>
                        <strong id="kembalianText" class="fs-6 text-success">Rp 0</strong>
                    </div>
                    <button type="submit" class="btn btn-gold w-100" id="btnSimpan" disabled>Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
let total = 0;
const fmt = n => 'Rp ' + Number(n).toLocaleString('id-ID');

function tambahItem() {
    const sel = document.getElementById('pilihProduk');
    const opt = sel.options[sel.selectedIndex];
    if (!opt.value) { alert('Pilih produk dulu.'); return; }
    const id = opt.value, nama = opt.dataset.nama;
    const harga = parseFloat(opt.dataset.harga), stok = parseInt(opt.dataset.stok);
    let qty = parseInt(document.getElementById('qtyInput').value) || 1;

    const existing = document.querySelector(`#cart tr[data-id="${id}"]`);
    if (existing) {
        const qInput = existing.querySelector('.qty');
        const newQty = parseInt(qInput.value) + qty;
        if (newQty > stok) { alert('Melebihi stok tersedia (' + stok + ').'); return; }
        qInput.value = newQty;
        hitungTotal();
        return;
    }
    if (qty > stok) { alert('Melebihi stok tersedia (' + stok + ').'); return; }

    document.getElementById('emptyRow')?.remove();
    const tr = document.createElement('tr');
    tr.dataset.id = id; tr.dataset.stok = stok; tr.dataset.harga = harga;
    tr.innerHTML = `
        <td><strong>${nama}</strong><input type="hidden" name="id_prdk[]" value="${id}"></td>
        <td class="text-end">${fmt(harga)}</td>
        <td class="text-center"><input type="number" name="qty[]" class="qty form-control form-control-sm mx-auto" style="width:75px;text-align:center" min="1" max="${stok}" value="${qty}" oninput="onQtyChange(this)"></td>
        <td class="text-end sub">${fmt(harga*qty)}</td>
        <td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="hapusItem(this)">×</button></td>`;
    document.getElementById('cart').appendChild(tr);
    hitungTotal();
    document.getElementById('qtyInput').value = 1;
}
function onQtyChange(input) {
    const tr = input.closest('tr');
    const stok = parseInt(tr.dataset.stok);
    let q = parseInt(input.value) || 1;
    if (q > stok) { q = stok; input.value = stok; }
    if (q < 1) { q = 1; input.value = 1; }
    tr.querySelector('.sub').textContent = fmt(tr.dataset.harga * q);
    hitungTotal();
}
function hapusItem(btn) {
    btn.closest('tr').remove();
    if (!document.querySelector('#cart tr')) {
        document.getElementById('cart').innerHTML = '<tr id="emptyRow"><td colspan="5" class="text-center text-secondary py-3">Belum ada barang.</td></tr>';
    }
    hitungTotal();
}
function hitungTotal() {
    total = 0;
    document.querySelectorAll('#cart tr[data-id]').forEach(tr => {
        total += parseFloat(tr.dataset.harga) * (parseInt(tr.querySelector('.qty').value) || 0);
    });
    document.getElementById('totalText').textContent = fmt(total);
    hitungKembalian();
}
function hitungKembalian() {
    const bayar = parseFloat(document.getElementById('bayar').value) || 0;
    const kembali = bayar - total;
    document.getElementById('kembalianText').textContent = fmt(kembali >= 0 ? kembali : 0);
    document.getElementById('btnSimpan').disabled = !(total > 0 && bayar >= total);
}
</script>
<?= $this->endSection() ?>
