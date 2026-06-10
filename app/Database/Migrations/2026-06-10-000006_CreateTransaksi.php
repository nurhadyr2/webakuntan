<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_trans'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'invoice'   => ['type' => 'VARCHAR', 'constraint' => 50],
            'tgl_trans' => ['type' => 'DATETIME'],
            'total'     => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'bayar'     => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'kembalian' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'id_user'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        ]);
        $this->forge->addKey('id_trans', true);
        $this->forge->addUniqueKey('invoice');
        $this->forge->createTable('transaksi', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('transaksi', true);
    }
}
