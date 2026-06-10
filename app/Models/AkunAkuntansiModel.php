<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunAkuntansiModel extends Model
{
    protected $table         = 'akun_akuntansi';
    protected $primaryKey    = 'id_akun';
    protected $returnType    = 'array';
    protected $allowedFields = ['kode_akun', 'nama_akun', 'posisi'];
    protected $useTimestamps = false;

    public function getByKode(string $kode)
    {
        return $this->where('kode_akun', $kode)->first();
    }
}
