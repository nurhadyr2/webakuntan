<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    var $PelangganModel;
    public function __construct()
    {
        $this->PelangganModel = new PelangganModel();
    }

    public function index()
    {
        $data = [
            
            'array' => $this->PelangganModel->alldata()
        ];
        return view('pelanggan/home', $data);
    }

    public function tambah()
    {
        return view('pelanggan/tambah');
    }

    public function simpan()
    {
        $data = [
            'id_pelanggan' => $this->request->getVar('id_pelanggan'),
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'bagian' => $this->request->getVar('bagian'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telepon' => $this->request->getVar('no_telepon'),

        ];
        $this->PelangganModel->tambahdata($data);
        return redirect()->to('pelanggan/home');
    }

    public function edit($id_pelanggan)
    {
        
        $data['pelanggan'] = $this->PelangganModel->getByID($id_pelanggan);
            
        if (!$data['pelanggan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        return view('pelanggan/edit', $data);
    }

    public function ubah($id_pelanggan)
    {
        $data = [
            'id_pelanggan'=> $id_pelanggan,
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'bagian' => $this->request->getVar('bagian'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telepon' => $this->request->getVar('no_telepon'),

        ];
        $this->PelangganModel->updatedata($data);
        return redirect()->to('pelanggan/home');
    }

    public function hapus($id_pelanggan)
    {
        $this->PelangganModel->deletedata($id);
        return redirect()->to('pelanggan/home');
    }

}
