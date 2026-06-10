<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table         = 'transaksi';
    protected $primaryKey    = 'id_trans';
    protected $returnType    = 'array';
    protected $allowedFields = ['invoice', 'tgl_trans', 'total', 'bayar', 'kembalian', 'id_user'];
    protected $useTimestamps = false;

    public function generateInvoice(): string
    {
        $prefix = 'INV-' . date('Ymd') . '-';
        $last   = $this->like('invoice', $prefix, 'after')
            ->orderBy('id_trans', 'DESC')
            ->first();

        $urut = 1;
        if ($last) {
            $potong = explode('-', $last['invoice']);
            $urut   = (int) end($potong) + 1;
        }
        return $prefix . str_pad((string) $urut, 4, '0', STR_PAD_LEFT);
    }

    public function byTanggal(?string $dari, ?string $sampai)
    {
        $builder = $this->orderBy('tgl_trans', 'DESC');
        if ($dari) {
            $builder->where('DATE(tgl_trans) >=', $dari);
        }
        if ($sampai) {
            $builder->where('DATE(tgl_trans) <=', $sampai);
        }
        return $builder->findAll();
    }
}
