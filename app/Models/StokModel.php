<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table         = 'stok';
    protected $primaryKey    = 'id_stok';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_kategori', 'id_barang', 'jml_stok', 'created_at'];
    protected $useTimestamps = false;

    public function withRelasi()
    {
        return $this->select('stok.*, produk.nama_produk, kategori.nama_kategori')
            ->join('produk', 'produk.id_produk = stok.id_barang', 'left')
            ->join('kategori', 'kategori.id_kategori = stok.id_kategori', 'left');
    }
}
