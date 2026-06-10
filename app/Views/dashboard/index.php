<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100"><div class="card-body">
            <div class="stat-ico ico-green mb-2"><i class="fa-solid fa-money-bill-wave"></i></div>
            <div class="text-secondary small">Penjualan Hari Ini</div>
            <div class="fs-4 highlight-gold">Rp <?= number_format($totalHari, 0, ',', '.') ?></div>
        </div></div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100"><div class="card-body">
            <div class="stat-ico ico-gold mb-2"><i class="fa-solid fa-calendar-days"></i></div>
            <div class="text-secondary small">Penjualan Bulan Ini</div>
            <div class="fs-4 highlight-gold">Rp <?= number_format($totalBulan, 0, ',', '.') ?></div>
        </div></div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100"><div class="card-body">
            <div class="stat-ico ico-navy mb-2"><i class="fa-solid fa-cart-shopping"></i></div>
            <div class="text-secondary small">Transaksi Hari Ini</div>
            <div class="fs-4 fw-bold" style="color:var(--navy)"><?= $jmlTransHari ?></div>
        </div></div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100"><div class="card-body">
            <div class="stat-ico ico-blue mb-2"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="text-secondary small">Produk Stok Menipis</div>
            <div class="fs-4 fw-bold" style="color:var(--navy)"><?= count($stokMenipis) ?></div>
        </div></div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">Grafik Penjualan 7 Hari Terakhir</div>
            <div class="card-body"><canvas id="chartPenjualan" height="110"></canvas></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">Reminder Stok</div>
            <div class="card-body">
                <?php if (empty($stokMenipis)): ?>
                    <p class="text-secondary mb-0">Semua stok aman 👍</p>
                <?php else: ?>
                    <table class="table table-sm align-middle mb-0">
                        <tbody>
                        <?php foreach ($stokMenipis as $p): ?>
                            <tr>
                                <td><?= esc($p['nama_produk']) ?></td>
                                <td class="text-end"><span class="badge text-bg-warning"><?= $p['stok'] ?> tersisa</span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/chart.umd.min.js') ?>"></script>
<script>
new Chart(document.getElementById('chartPenjualan'), {
    type: 'line',
    data: {
        labels: <?= json_encode(array_column($grafik, 'label')) ?>,
        datasets: [{
            label: 'Penjualan (Rp)',
            data: <?= json_encode(array_column($grafik, 'value')) ?>,
            borderColor: '#c9a227', backgroundColor: 'rgba(201,162,39,.12)',
            fill: true, tension: .35, pointBackgroundColor: '#0f2440', pointRadius: 3, borderWidth: 2.5
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') } } }
    }
});
</script>
<?= $this->endSection() ?>
