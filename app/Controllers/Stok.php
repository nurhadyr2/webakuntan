<?php

namespace App\Controllers;

use App\Models\StokModel;
use App\Models\ProdukModel;

class Stok extends BaseController
{
    protected StokModel $model;
    protected ProdukModel $produkModel;

    public function __construct()
    {
        $this->model       = new StokModel();
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        return view('stok/index', [
            'title'      => 'Stok Barang',
            'breadcrumb' => 'Master Data / Stok Barang',
            'stok'       => $this->model->withRelasi()->orderBy('id_stok', 'DESC')->findAll(),
            'produk'     => $this->produkModel->withKategori()->orderBy('nama_produk', 'ASC')->findAll(),
        ]);
    }

    public function simpan()
    {
        $rules = [
            'id_barang' => 'required|is_not_unique[produk.id_produk]',
            'jml_stok'  => 'required|integer|greater_than[0]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $idBarang = (int) $this->request->getPost('id_barang');
        $jml      = (int) $this->request->getPost('jml_stok');
        $produk   = $this->produkModel->find($idBarang);

        if (! $produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $this->model->insert([
            'id_kategori' => $produk['id_kategori'],
            'id_barang'   => $idBarang,
            'jml_stok'    => $jml,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->produkModel->update($idBarang, ['stok' => $produk['stok'] + $jml]);

        return redirect()->to('/stok')->with('success', "Stok {$produk['nama_produk']} bertambah {$jml}.");
    }

    public function hapus($id)
    {
        $stok = $this->model->find($id);
        if ($stok) {
            $produk = $this->produkModel->find($stok['id_barang']);
            if ($produk) {
                $baru = max(0, $produk['stok'] - $stok['jml_stok']);
                $this->produkModel->update($stok['id_barang'], ['stok' => $baru]);
            }
            $this->model->delete($id);
        }
        return redirect()->to('/stok')->with('success', 'Catatan stok masuk dihapus & stok produk disesuaikan.');
    }
}
