<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurnalUmum extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jurnal'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_trans'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'no_jurnal'  => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'tanggal'    => ['type' => 'DATE'],
            'keterangan' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id_jurnal', true);
        $this->forge->createTable('jurnal_umum', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('jurnal_umum', true);
    }
}
