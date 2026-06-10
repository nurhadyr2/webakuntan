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
    <div class="login-wrap">
        <div class="card login-card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <div class="login-logo">SP</div>
                <h1 class="h4 text-center mb-1" style="color:var(--navy)">Sistem Penjualan</h1>
                <p class="text-center text-secondary small mb-4">Sistem Informasi Akuntansi Penjualan</p>

                <?php if (session('error')): ?>
                    <div class="alert alert-danger py-2"><?= esc(session('error')) ?></div>
                <?php endif; ?>
                <?php if (session('success')): ?>
                    <div class="alert alert-success py-2"><?= esc(session('success')) ?></div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?= old('username') ?>" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-gold w-100 py-2"><i class="fa-solid fa-right-to-bracket me-1"></i> Masuk</button>
                </form>

                <div class="text-center text-secondary mt-4" style="font-size:11.5px;">
                    Demo &mdash; Owner: <b>owner / owner123</b><br>
                    Kasir: <b>kasir / kasir123</b>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
