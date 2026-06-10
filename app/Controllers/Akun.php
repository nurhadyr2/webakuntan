<?php

namespace App\Controllers;

use App\Models\AkunAkuntansiModel;

class Akun extends BaseController
{
    protected AkunAkuntansiModel $model;

    public function __construct()
    {
        $this->model = new AkunAkuntansiModel();
    }

    public function index()
    {
        return view('akun/index', [
            'title'      => 'Akun Akuntansi',
            'breadcrumb' => 'Master Data / Akun Akuntansi',
            'akun'       => $this->model->orderBy('kode_akun', 'ASC')->findAll(),
        ]);
    }

    public function simpan()
    {
        $rules = [
            'kode_akun' => 'required|max_length[30]|is_unique[akun_akuntansi.kode_akun]',
            'nama_akun' => 'required|max_length[100]',
            'posisi'    => 'required|in_list[debit,kredit]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $this->model->insert($this->request->getPost(['kode_akun', 'nama_akun', 'posisi']));
        return redirect()->to('/akun')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function update($id)
    {
        $rules = [
            'kode_akun' => "required|max_length[30]|is_unique[akun_akuntansi.kode_akun,id_akun,{$id}]",
            'nama_akun' => 'required|max_length[100]',
            'posisi'    => 'required|in_list[debit,kredit]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('error', implode(' ', $this->validator->getErrors()));
        }
        $this->model->update($id, $this->request->getPost(['kode_akun', 'nama_akun', 'posisi']));
        return redirect()->to('/akun')->with('success', 'Akun berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/akun')->with('success', 'Akun berhasil dihapus.');
    }
}
