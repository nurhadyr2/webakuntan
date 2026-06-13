<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Akuntansi Penjualan</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <div class="login-page">
        <aside class="login-aside">
            <div class="brand">
                <div class="brand-logo">SP</div>
                <div class="brand-text">
                    <strong>Sistem Penjualan</strong>
                    <span>Owner &amp; Kasir</span>
                </div>
            </div>

            <div class="login-hero">
                <span class="login-tag">Sistem Informasi Akuntansi Penjualan</span>
                <h1>Sistem Informasi Akuntansi Penjualan Toko Qonita Jaya</h1>
                <p>Transaksi kasir cepat, pencatatan jurnal otomatis, sampai laporan keuangan — semuanya dalam satu aplikasi.</p>
                <ul class="feature-list">
                    <li><i class="fa-solid fa-circle-check"></i> Transaksi kasir dengan invoice otomatis</li>
                    <li><i class="fa-solid fa-circle-check"></i> Jurnal umum &amp; buku besar otomatis</li>
                    <li><i class="fa-solid fa-circle-check"></i> Laporan penjualan &amp; laba rugi</li>
                </ul>
            </div>

            <div class="foot">&copy; <?= date('Y') ?> Sistem Informasi Akuntansi Penjualan</div>
        </aside>

        <main class="login-main">
            <div class="login-form">
                <h2>Selamat Datang</h2>
                <p class="sub">Masuk ke akun Anda untuk melanjutkan</p>

                <?php if (session('error')): ?>
                    <div class="alert alert-danger py-2"><?= esc(session('error')) ?></div>
                <?php endif; ?>
                <?php if (session('success')): ?>
                    <div class="alert alert-success py-2"><?= esc(session('success')) ?></div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?= old('username') ?>" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-navy w-100 py-2">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk ke Sistem
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
