<?php
$role    = session('hak_akses');
$nama    = session('nama_user') ?? 'User';
$current = service('uri')->getSegment(1);
$inisial = strtoupper(mb_substr($nama, 0, 2));
function navActive($seg, $current) { return $seg === $current ? 'active' : ''; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?> — Sistem Penjualan</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <?= $this->renderSection('head') ?>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">SP</div>
            <div class="brand-text">
                <strong>Sistem Penjualan</strong>
                <span>Akuntansi &amp; Kasir</span>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar"><?= esc($inisial) ?></div>
            <div class="meta">
                <strong><?= esc($nama) ?></strong>
                <span><?= ucfirst($role ?? '') ?></span>
            </div>
        </div>

        <nav class="pb-3">
            <div class="nav-section">Utama</div>
            <a class="nav-link-side <?= navActive('dashboard', $current) ?>" href="<?= base_url('dashboard') ?>"><span class="ico"><i class="fa-solid fa-gauge-high"></i></span> Dashboard</a>

            <?php if ($role === 'owner'): ?>
            <div class="nav-section">Master Data</div>
            <a class="nav-link-side <?= navActive('kategori', $current) ?>" href="<?= base_url('kategori') ?>"><span class="ico"><i class="fa-solid fa-tags"></i></span> Kategori</a>
            <a class="nav-link-side <?= navActive('produk', $current) ?>" href="<?= base_url('produk') ?>"><span class="ico"><i class="fa-solid fa-box"></i></span> Data Produk</a>
            <a class="nav-link-side <?= navActive('stok', $current) ?>" href="<?= base_url('stok') ?>"><span class="ico"><i class="fa-solid fa-warehouse"></i></span> Stok Barang</a>
            <a class="nav-link-side <?= navActive('akun', $current) ?>" href="<?= base_url('akun') ?>"><span class="ico"><i class="fa-solid fa-book"></i></span> Akun Akuntansi</a>
            <?php endif; ?>

            <div class="nav-section">Operasional</div>
            <a class="nav-link-side <?= navActive('transaksi', $current) ?>" href="<?= base_url('transaksi') ?>"><span class="ico"><i class="fa-solid fa-cart-shopping"></i></span> Transaksi</a>
            <a class="nav-link-side <?= navActive('histori', $current) ?>" href="<?= base_url('histori') ?>"><span class="ico"><i class="fa-solid fa-receipt"></i></span> Histori Transaksi</a>

            <?php if ($role === 'owner'): ?>
            <div class="nav-section">Catatan Akuntansi</div>
            <a class="nav-link-side <?= navActive('jurnal', $current) ?>" href="<?= base_url('jurnal') ?>"><span class="ico"><i class="fa-solid fa-book-open"></i></span> Jurnal Umum</a>
            <a class="nav-link-side <?= navActive('bukubesar', $current) ?>" href="<?= base_url('bukubesar') ?>"><span class="ico"><i class="fa-solid fa-book-bookmark"></i></span> Buku Besar</a>

            <div class="nav-section">Laporan</div>
            <a class="nav-link-side <?= navActive('laporan-penjualan', $current) ?>" href="<?= base_url('laporan-penjualan') ?>"><span class="ico"><i class="fa-solid fa-chart-line"></i></span> Laporan Penjualan</a>
            <a class="nav-link-side <?= navActive('laporan-labarugi', $current) ?>" href="<?= base_url('laporan-labarugi') ?>"><span class="ico"><i class="fa-solid fa-sack-dollar"></i></span> Laporan Laba Rugi</a>
            <?php endif; ?>

            <div class="nav-section">Akun</div>
            <a class="nav-link-side" href="<?= base_url('logout') ?>"><span class="ico"><i class="fa-solid fa-right-from-bracket"></i></span> Keluar</a>
        </nav>
    </aside>

    <div class="main">
        <header class="topbar">
            <div>
                <div class="page-title"><?= esc($title ?? 'Dashboard') ?></div>
                <div class="crumb"><?= esc($breadcrumb ?? 'Dashboard') ?></div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="date"><?= date('l, d M Y') ?></span>
            </div>
        </header>

        <main class="content">
            <?php if (session('error')): ?>
                <div class="alert alert-danger"><?= esc(session('error')) ?></div>
            <?php endif; ?>
            <?php if (session('success')): ?>
                <div class="alert alert-success"><?= esc(session('success')) ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>
<script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
