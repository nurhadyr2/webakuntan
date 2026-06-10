<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class Histori extends BaseController
{
    protected TransaksiModel $transaksiModel;
    protected DetailTransaksiModel $detailModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->detailModel    = new DetailTransaksiModel();
    }

    public function index()
    {
        $dari   = $this->request->getGet('dari');
        $sampai = $this->request->getGet('sampai');

        $data = $this->transaksiModel->byTanggal($dari, $sampai);

        return view('histori/index', [
            'title'      => 'Histori Transaksi',
            'breadcrumb' => 'Operasional / Histori Transaksi',
            'transaksi'  => $data,
            'dari'       => $dari,
            'sampai'     => $sampai,
            'totalOmzet' => array_sum(array_column($data, 'total')),
        ]);
    }

    public function detail($idTrans)
    {
        $trx = $this->transaksiModel->find($idTrans);
        if (! $trx) {
            return redirect()->to('/histori')->with('error', 'Transaksi tidak ditemukan.');
        }
        return view('histori/detail', [
            'title'      => 'Detail ' . $trx['invoice'],
            'breadcrumb' => 'Operasional / Histori / Detail',
            'trx'        => $trx,
            'detail'     => $this->detailModel->byTransaksi($idTrans),
        ]);
    }
}
