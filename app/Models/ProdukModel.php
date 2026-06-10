<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table         = 'produk';
    protected $primaryKey    = 'id_produk';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_kategori', 'nama_produk', 'harga', 'stok'];
    protected $useTimestamps = false;

    public function withKategori()
    {
        return $this->select('produk.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
    }

    public function stokMenipis(int $ambang = 5)
    {
        return $this->where('stok <=', $ambang)->orderBy('stok', 'ASC')->findAll();
    }
}
