<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkunAkuntansi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_akun'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_akun'  => ['type' => 'VARCHAR', 'constraint' => 30],
            'nama_akun'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'posisi'     => ['type' => 'ENUM', 'constraint' => ['debit', 'kredit']],
        ]);
        $this->forge->addKey('id_akun', true);
        $this->forge->addUniqueKey('kode_akun');
        $this->forge->createTable('akun_akuntansi', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('akun_akuntansi', true);
    }
}
