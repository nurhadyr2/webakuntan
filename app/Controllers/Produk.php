<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{



    //function constructor untuk harus di buat terlebih dahulu
    var $ProdukModel;
    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
    }



    public function menampilkanData()
    {
        
        $data = [
            //(id_produk) Menyesuaikan primary key yang ada di soal

            //$this->ProdukModel->orderBy('id_produk', 'asc')->findAll()
            'array' => []
        ];
        return view('home', $data);
    }











    //function untuk masuk ke view/tampilan tambah data
    public function tambahData()
    {
        return view('tambah');
    }

    //function untuk menyimpan data
    public function simpanData()
    {
        $this->ProdukModel->insert([
            'id_produk' => $this->request->getVar('id_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),

        ]);

        return redirect()->to('/');
    }











    //function untuk mengarahkan ke view edit
    public function edit($id)
    {
        
        $data = [
            //untuk (id_produk) Menyesuaikan primary key yang ada di soal
            //$this->ProdukModel->where(['id_produk' => $id])->first() 
            'kolom' => []

        ];
        return view('edit', $data);
    }

    
    //fuuction untuk mengubah data
    public function ubah($id)
    {
        $this->ProdukModel->update($id,[
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),

        ]);

        return redirect()->to('/');
    }









    //function untuk hapus data
    public function hapus($id)
    {
        $this->ProdukModel->delete($id);
        return redirect()->to('/');
    }
}
