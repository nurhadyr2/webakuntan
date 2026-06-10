<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailJurnalUmumModel extends Model
{
    protected $table         = 'detail_jurnal_umum';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_jurnal', 'id_akun', 'debit', 'kredit'];
    protected $useTimestamps = false;

    public function byJurnal(int $idJurnal)
    {
        return $this->select('detail_jurnal_umum.*, akun_akuntansi.kode_akun, akun_akuntansi.nama_akun, akun_akuntansi.posisi')
            ->join('akun_akuntansi', 'akun_akuntansi.id_akun = detail_jurnal_umum.id_akun', 'left')
            ->where('id_jurnal', $idJurnal)
            ->findAll();
    }

    public function mutasiAkun(int $idAkun, ?string $dari, ?string $sampai)
    {
        $builder = $this->select('detail_jurnal_umum.*, jurnal_umum.tanggal, jurnal_umum.keterangan, jurnal_umum.no_jurnal')
            ->join('jurnal_umum', 'jurnal_umum.id_jurnal = detail_jurnal_umum.id_jurnal', 'left')
            ->where('detail_jurnal_umum.id_akun', $idAkun)
            ->orderBy('jurnal_umum.tanggal', 'ASC')
            ->orderBy('detail_jurnal_umum.id', 'ASC');
        if ($dari) {
            $builder->where('jurnal_umum.tanggal >=', $dari);
        }
        if ($sampai) {
            $builder->where('jurnal_umum.tanggal <=', $sampai);
        }
        return $builder->findAll();
    }
}
