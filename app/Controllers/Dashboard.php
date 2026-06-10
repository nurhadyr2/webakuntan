<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\ProdukModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $produkModel    = new ProdukModel();

        $hariIni  = date('Y-m-d');
        $bulanIni = date('Y-m');

        $totalHari = $transaksiModel
            ->selectSum('total')
            ->where('DATE(tgl_trans)', $hariIni)
            ->first()['total'] ?? 0;

        $totalBulan = $transaksiModel
            ->selectSum('total')
            ->where("DATE_FORMAT(tgl_trans, '%Y-%m')", $bulanIni)
            ->first()['total'] ?? 0;

        $jmlTransHari = $transaksiModel->where('DATE(tgl_trans)', $hariIni)->countAllResults();
        $stokMenipis  = $produkModel->stokMenipis(5);

        $grafik = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i days"));
            $sum = $transaksiModel->selectSum('total')->where('DATE(tgl_trans)', $tgl)->first()['total'] ?? 0;
            $grafik[] = ['label' => date('d/m', strtotime($tgl)), 'value' => (float) $sum];
        }

        return view('dashboard/index', [
            'title'        => 'Dashboard',
            'breadcrumb'   => 'Dashboard',
            'totalHari'    => $totalHari,
            'totalBulan'   => $totalBulan,
            'jmlTransHari' => $jmlTransHari,
            'stokMenipis'  => $stokMenipis,
            'grafik'       => $grafik,
        ]);
    }
}
