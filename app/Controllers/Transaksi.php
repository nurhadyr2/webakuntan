<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransaksiModel;
use App\Models\PelangganModel;

class Transaksi extends BaseController
{
    var $TransaksiModel;
    public function __construct()
    {
        $this->TransaksiModel = new TransaksiModel();
        $this->PelangganModel = new PelangganModel();
    }

    public function index()
    {
        
        $data = [
            
            'array' => $this->TransaksiModel->orderBy('id_pelanggan', 'asc')->findAll()
        ];
        return view('transaksi/home', $data);
    }
    
    public function getjatuhtempo()
    {
        $tgl = $this->input->post('tgl');
        $jatuh_tempo = date('dd-mm-yyy', strtotime("+1 month", strtotime($tgl)));
        echo $jatuh_tempo;
    }

    public function tambah()
    {
        return view('transaksi/tambah');
    }

    public function input()
    {
        $data['array'] = $this->PelangganModel->alldata();
        return view('transaksi/tambah', $data);
    }
}
