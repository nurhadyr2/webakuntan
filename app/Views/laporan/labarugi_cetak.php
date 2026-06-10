<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Laba Rugi</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #1d2733; margin: 36px; font-size: 13px; }
        .head { text-align: center; border-bottom: 3px double #0d1b2a; padding-bottom: 12px; margin-bottom: 18px; }
        .head h1 { margin: 0; font-size: 20px; color: #0d1b2a; }
        .head .sub { color: #6b7785; font-size: 13px; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin: 6px 0; }
        td { padding: 7px 10px; border: 1px solid #d8d2c4; }
        .text-end { text-align: right; }
        h3 { margin: 16px 0 4px; font-size: 14px; }
        .sub-total td { font-weight: 700; background: #f8f1dd; }
        .laba { display:flex; justify-content:space-between; margin-top:18px; padding:14px 16px; background:#0d1b2a; color:#fff; border-radius:6px; font-weight:700; }
        .meta { font-size: 12px; color: #6b7785; margin-bottom: 6px; }
        @media print { .noprint { display: none; } body { margin: 12px; } }
        .btn { padding: 8px 16px; background: #c9a227; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body onload="window.print()">
    <div class="noprint" style="text-align:right;margin-bottom:12px;">
        <button class="btn" onclick="window.print()">🖨 Cetak / Simpan PDF</button>
    </div>
    <div class="head">
        <h1>LAPORAN LABA RUGI</h1>
        <div class="sub">Sistem Informasi Akuntansi Penjualan</div>
    </div>
    <div class="meta">Periode: <?= date('d M Y', strtotime($dari)) ?> s/d <?= date('d M Y', strtotime($sampai)) ?></div>

    <h3>Pendapatan</h3>
    <table>
        <?php foreach ($pendapatan as $p): ?>
            <tr><td><?= esc($p['akun']['kode_akun']) ?> &ndash; <?= esc($p['akun']['nama_akun']) ?></td>
                <td class="text-end" style="width:180px"><?= number_format($p['jumlah'], 0, ',', '.') ?></td></tr>
        <?php endforeach; ?>
        <?php if (empty($pendapatan)): ?><tr><td colspan="2">-</td></tr><?php endif; ?>
        <tr class="sub-total"><td>Total Pendapatan</td><td class="text-end"><?= number_format($totalPendapatan, 0, ',', '.') ?></td></tr>
    </table>

    <h3>Beban</h3>
    <table>
        <?php foreach ($beban as $b): ?>
            <tr><td><?= esc($b['akun']['kode_akun']) ?> &ndash; <?= esc($b['akun']['nama_akun']) ?></td>
                <td class="text-end" style="width:180px"><?= number_format($b['jumlah'], 0, ',', '.') ?></td></tr>
        <?php endforeach; ?>
        <?php if (empty($beban)): ?><tr><td colspan="2">-</td></tr><?php endif; ?>
        <tr class="sub-total"><td>Total Beban</td><td class="text-end"><?= number_format($totalBeban, 0, ',', '.') ?></td></tr>
    </table>

    <div class="laba"><span>LABA BERSIH</span><span>Rp <?= number_format($labaBersih, 0, ',', '.') ?></span></div>

    <div style="margin-top:40px;text-align:right;font-size:12px;">
        Dicetak: <?= date('d M Y H:i') ?><br><br><br>( ________________________ )
    </div>
</body>
</html>
