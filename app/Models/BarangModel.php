<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
  protected $table            = 'barang';
  protected $primaryKey       = 'kd_barang';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [];

   public function alldata()
   {
     return $this->db->table('barang')
     ->get()
     ->getResultArray();
   }

   public function tambahdata($data)
   {
    $this->db->table('barang')->insert($data);
   }

   public function getByID($kd_barang)
   {
       return $this->db->table('barang')->where('kd_barang', $kd_barang)
       ->get()
       ->getRowArray();
   }
   
   public function updatedata($data)
   {
    $this->db->table('barang')
    ->where('kd_barang', $data['kd_barang'])
    ->update($data);
   }

   public function deletedata($kd_barang)
   {
    $this->db->table('barang')
    ->where('kd_barang', $kd_barang)
    ->delete();
   }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
