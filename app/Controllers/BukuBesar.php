<?php

namespace App\Controllers;

use App\Models\AkunAkuntansiModel;
use App\Models\DetailJurnalUmumModel;

class BukuBesar extends BaseController
{
    public function index()
    {
        $akunModel   = new AkunAkuntansiModel();
        $detailModel = new DetailJurnalUmumModel();

        $idAkun = $this->request->getGet('id_akun');
        $dari   = $this->request->getGet('dari') ?: date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?: date('Y-m-t');

        $akun        = null;
        $mutasi      = [];
        $saldoAwal   = 0;
        $totalDebit  = 0;
        $totalKredit = 0;
        $saldoAkhir  = 0;

        if ($idAkun) {
            $akun = $akunModel->find($idAkun);

            // saldo awal dibawa dari mutasi sebelum tanggal "dari"
            $sebelum = $detailModel->mutasiAkun((int) $idAkun, null, date('Y-m-d', strtotime($dari . ' -1 day')));
            foreach ($sebelum as $s) {
                $saldoAwal += $this->arah($akun['posisi'], $s['debit'], $s['kredit']);
            }

            $rows  = $detailModel->mutasiAkun((int) $idAkun, $dari, $sampai);
            $saldo = $saldoAwal;
            foreach ($rows as $r) {
                $saldo      += $this->arah($akun['posisi'], $r['debit'], $r['kredit']);
                $r['saldo']  = $saldo;
                $mutasi[]    = $r;
                $totalDebit  += $r['debit'];
                $totalKredit += $r['kredit'];
            }
            $saldoAkhir = $saldo;
        }

        return view('bukubesar/index', [
            'title'       => 'Buku Besar',
            'breadcrumb'  => 'Catatan Akuntansi / Buku Besar',
            'akunList'    => $akunModel->orderBy('kode_akun', 'ASC')->findAll(),
            'akun'        => $akun,
            'mutasi'      => $mutasi,
            'saldoAwal'   => $saldoAwal,
            'saldoAkhir'  => $saldoAkhir,
            'totalDebit'  => $totalDebit,
            'totalKredit' => $totalKredit,
            'idAkun'      => $idAkun,
            'dari'        => $dari,
            'sampai'      => $sampai,
        ]);
    }

    protected function arah(string $posisi, $debit, $kredit): float
    {
        return $posisi === 'debit'
            ? ($debit - $kredit)
            : ($kredit - $debit);
    }
}
