<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    protected ProdukModel $model;
    protected KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->model         = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        return view('produk/index', [
            'title'      => 'Data Produk',
            'breadcrumb' => 'Master Data / Data Produk',
            'produk'     => $this->model->withKategori()->orderBy('id_produk', 'DESC')->findAll(),
            'kategori'   => $this->kategoriModel->orderBy('nama_kategori', 'ASC')->findAll(),
        ]);
    }

    public function simpan()
    {
        $rules = [
            'id_kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'nama_produk' => 'required|max_length[100]',
            'harga'       => 'required|numeric',
            'stok'        => 'permit_empty|integer',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $this->model->insert([
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => (int) $this->request->getPost('stok'),
        ]);
        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update($id)
    {
        $rules = [
            'id_kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'nama_produk' => 'required|max_length[100]',
            'harga'       => 'required|numeric',
            'stok'        => 'permit_empty|integer',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $this->model->update($id, [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => (int) $this->request->getPost('stok'),
        ]);
        return redirect()->to('/produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
