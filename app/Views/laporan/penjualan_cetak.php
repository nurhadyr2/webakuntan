<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #1d2733; margin: 36px; font-size: 13px; }
        .head { text-align: center; border-bottom: 3px double #0d1b2a; padding-bottom: 12px; margin-bottom: 18px; }
        .head h1 { margin: 0; font-size: 20px; color: #0d1b2a; }
        .head .sub { color: #6b7785; font-size: 13px; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { padding: 8px 10px; border: 1px solid #d8d2c4; }
        th { background: #0d1b2a; color: #fff; text-align: left; font-size: 12px; }
        .text-end { text-align: right; }
        tfoot td { font-weight: 700; background: #f8f1dd; }
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
        <h1>LAPORAN PENJUALAN</h1>
        <div class="sub">Sistem Informasi Akuntansi Penjualan</div>
    </div>
    <div class="meta">Periode: <?= date('d M Y', strtotime($dari)) ?> s/d <?= date('d M Y', strtotime($sampai)) ?></div>
    <table>
        <thead>
            <tr><th style="width:50px">No</th><th>Invoice</th><th>Tanggal</th><th class="text-end" style="width:160px">Total (Rp)</th></tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr><td colspan="4" style="text-align:center;color:#888">Tidak ada data.</td></tr>
            <?php else: foreach ($data as $i => $t): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($t['invoice']) ?></td>
                    <td><?= date('d M Y H:i', strtotime($t['tgl_trans'])) ?></td>
                    <td class="text-end"><?= number_format($t['total'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
        <tfoot>
            <tr><td colspan="3" class="text-end">TOTAL</td><td class="text-end"><?= number_format($total, 0, ',', '.') ?></td></tr>
        </tfoot>
    </table>
    <div style="margin-top:40px;text-align:right;font-size:12px;">
        Dicetak: <?= date('d M Y H:i') ?><br><br><br>
        ( ________________________ )
    </div>
</body>
</html>
