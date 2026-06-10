<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected KategoriModel $model;

    public function __construct()
    {
        $this->model = new KategoriModel();
    }

    public function index()
    {
        return view('kategori/index', [
            'title'      => 'Kategori',
            'breadcrumb' => 'Master Data / Kategori',
            'kategori'   => $this->model->orderBy('id_kategori', 'DESC')->findAll(),
        ]);
    }

    public function simpan()
    {
        if (! $this->validate(['nama_kategori' => 'required|max_length[100]'])) {
            return redirect()->back()->with('error', 'Nama kategori wajib diisi.');
        }
        $this->model->insert(['nama_kategori' => $this->request->getPost('nama_kategori')]);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update($id)
    {
        if (! $this->validate(['nama_kategori' => 'required|max_length[100]'])) {
            return redirect()->back()->with('error', 'Nama kategori wajib diisi.');
        }
        $this->model->update($id, ['nama_kategori' => $this->request->getPost('nama_kategori')]);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
