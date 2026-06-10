<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailJurnalUmumModel;
use App\Models\AkunAkuntansiModel;

class Laporan extends BaseController
{
    public function penjualan()
    {
        [$dari, $sampai, $data, $total] = $this->dataPenjualan();

        return view('laporan/penjualan', [
            'title'      => 'Laporan Penjualan',
            'breadcrumb' => 'Laporan / Laporan Penjualan',
            'data'       => $data,
            'total'      => $total,
            'dari'       => $dari,
            'sampai'     => $sampai,
        ]);
    }

    public function cetakPenjualan()
    {
        [$dari, $sampai, $data, $total] = $this->dataPenjualan();

        return view('laporan/penjualan_cetak', [
            'data'   => $data,
            'total'  => $total,
            'dari'   => $dari,
            'sampai' => $sampai,
        ]);
    }

    private function dataPenjualan(): array
    {
        $dari   = $this->request->getGet('dari') ?: date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?: date('Y-m-t');

        $data  = (new TransaksiModel())->byTanggal($dari, $sampai);
        $total = array_sum(array_column($data, 'total'));

        return [$dari, $sampai, $data, $total];
    }

    public function labaRugi()
    {
        $r = $this->dataLabaRugi();

        return view('laporan/labarugi', array_merge($r, [
            'title'      => 'Laporan Laba Rugi',
            'breadcrumb' => 'Laporan / Laporan Laba Rugi',
        ]));
    }

    public function cetakLabaRugi()
    {
        return view('laporan/labarugi_cetak', $this->dataLabaRugi());
    }

    // pendapatan = akun kode 4xx, beban = akun kode 5xx/6xx, dihitung dari jurnal umum
    private function dataLabaRugi(): array
    {
        $dari   = $this->request->getGet('dari') ?: date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?: date('Y-m-t');

        $akunModel   = new AkunAkuntansiModel();
        $detailModel = new DetailJurnalUmumModel();

        $pendapatan = [];
        $beban      = [];
        $totalPendapatan = 0;
        $totalBeban      = 0;

        foreach ($akunModel->orderBy('kode_akun', 'ASC')->findAll() as $a) {
            $kodeAwal = substr($a['kode_akun'], 0, 1);
            $isPendapatan = $kodeAwal === '4';
            $isBeban      = in_array($kodeAwal, ['5', '6'], true);
            if (! $isPendapatan && ! $isBeban) {
                continue;
            }

            $mutasi = $detailModel->mutasiAkun((int) $a['id_akun'], $dari, $sampai);
            $jumlah = 0;
            foreach ($mutasi as $m) {
                $jumlah += $isPendapatan ? ($m['kredit'] - $m['debit']) : ($m['debit'] - $m['kredit']);
            }
            if ($jumlah == 0) {
                continue;
            }

            if ($isPendapatan) {
                $pendapatan[] = ['akun' => $a, 'jumlah' => $jumlah];
                $totalPendapatan += $jumlah;
            } else {
                $beban[] = ['akun' => $a, 'jumlah' => $jumlah];
                $totalBeban += $jumlah;
            }
        }

        return [
            'pendapatan'      => $pendapatan,
            'beban'           => $beban,
            'totalPendapatan' => $totalPendapatan,
            'totalBeban'      => $totalBeban,
            'labaBersih'      => $totalPendapatan - $totalBeban,
            'dari'            => $dari,
            'sampai'          => $sampai,
        ];
    }
}
