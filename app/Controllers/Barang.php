<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BarangModel;

class Barang extends BaseController
{
    var $BarangModel;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
    }

    public function index()
    {
        
        $data = [
            
            'barang' => $this->BarangModel->alldata()
        ];
        return view('barang/home', $data);
    }

    public function tambah()
    {
        return view('barang/tambah');
    }

    public function simpan()
    {
        $data = [
            'kd_barang' => $this->request->getVar('kd_barang'),
            'nama_barang' => $this->request->getVar('nama_barang'),
        ];

        $this->BarangModel->tambahdata($data);
        return redirect()->to('barang/home');
    }

    public function edit($kd_barang)
    {
        $data['b'] = $this->BarangModel->getByID($kd_barang);
            
        if (!$data['b']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        return view('barang/edit', $data);
    }

    public function ubah($kd_barang)
    {
        $data = [
            'kd_barang' => $kd_barang,
            'nama_barang' => $this->request->getVar('nama_barang'),
        ];

        $this->BarangModel->updatedata($data);

        return redirect()->to('barang/home');
    }

    public function hapus($kd_barang)
    {
        $this->BarangModel->deletedata($kd_barang);
        
        return redirect()->to('barang/home');
    }

}
