<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalUmumModel extends Model
{
    protected $table         = 'jurnal_umum';
    protected $primaryKey    = 'id_jurnal';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_trans', 'no_jurnal', 'tanggal', 'keterangan'];
    protected $useTimestamps = false;

    public function generateNoJurnal(): string
    {
        $last = $this->orderBy('id_jurnal', 'DESC')->first();
        $urut = $last ? ((int) substr($last['no_jurnal'] ?? '0', 4) + 1) : 1;
        return 'TRX-' . str_pad((string) $urut, 5, '0', STR_PAD_LEFT);
    }

    public function jurnalLengkap(?string $dari, ?string $sampai)
    {
        $builder = $this->orderBy('tanggal', 'ASC')->orderBy('id_jurnal', 'ASC');
        if ($dari) {
            $builder->where('tanggal >=', $dari);
        }
        if ($sampai) {
            $builder->where('tanggal <=', $sampai);
        }
        return $builder->findAll();
    }
}
