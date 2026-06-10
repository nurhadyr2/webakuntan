<?php

namespace App\Controllers;

use App\Models\JurnalUmumModel;
use App\Models\DetailJurnalUmumModel;

class Jurnal extends BaseController
{
    public function index()
    {
        $dari   = $this->request->getGet('dari') ?: date('Y-m-01');
        $sampai = $this->request->getGet('sampai') ?: date('Y-m-t');

        $jurnalModel = new JurnalUmumModel();
        $detailModel = new DetailJurnalUmumModel();

        $jurnals = $jurnalModel->jurnalLengkap($dari, $sampai);

        $rows = [];
        $totalDebit = 0;
        $totalKredit = 0;
        foreach ($jurnals as $j) {
            $details = $detailModel->byJurnal($j['id_jurnal']);
            $rows[] = ['header' => $j, 'details' => $details];
            foreach ($details as $d) {
                $totalDebit  += $d['debit'];
                $totalKredit += $d['kredit'];
            }
        }

        return view('jurnal/index', [
            'title'       => 'Jurnal Umum',
            'breadcrumb'  => 'Catatan Akuntansi / Jurnal Umum',
            'rows'        => $rows,
            'dari'        => $dari,
            'sampai'      => $sampai,
            'totalDebit'  => $totalDebit,
            'totalKredit' => $totalKredit,
        ]);
    }
}
