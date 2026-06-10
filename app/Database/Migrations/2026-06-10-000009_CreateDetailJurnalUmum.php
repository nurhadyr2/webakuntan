<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailJurnalUmum extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_jurnal' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_akun'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'debit'     => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'kredit'    => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_jurnal', 'jurnal_umum', 'id_jurnal', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_akun', 'akun_akuntansi', 'id_akun', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_jurnal_umum', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('detail_jurnal_umum', true);
    }
}
