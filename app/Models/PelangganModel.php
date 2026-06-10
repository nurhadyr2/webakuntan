<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id_pelanggan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function alldata()
   {
      $this->db->table('pelanggan')
     ->get()
     ->getResultArray();
   }

   public function tambahdata($data)
   {
    $this->db->table('pelanggan')->insert($data);
   }

   public function getByID($id_pelanggan)
   {
       return $this->db->table('pelanggan')->where('id_pelanggan', $id_pelanggan)
       ->get()
       ->getRowArray();
   }
   
   public function updatedata($data)
   {
    $this->db->table('pelanggan')
    ->where('id_pelanggan', $data['id_pelanggan'])
    ->update($data);
   }

   public function deletedata($id_pelanggan)
   {
    $this->db->table('pelanggan')
    ->where('id_pelanggan', $id_pelanggan)
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
