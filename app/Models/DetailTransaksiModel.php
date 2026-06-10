<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table         = 'detail_transaksi';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_trans', 'id_prdk', 'qty', 'harga', 'sub_total'];
    protected $useTimestamps = false;

    public function byTransaksi(int $idTrans)
    {
        return $this->select('detail_transaksi.*, produk.nama_produk')
            ->join('produk', 'produk.id_produk = detail_transaksi.id_prdk', 'left')
            ->where('id_trans', $idTrans)
            ->findAll();
    }
}
