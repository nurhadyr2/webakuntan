<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_user', 'username', 'password', 'hak_akses'];
    protected $useTimestamps    = false;
}
