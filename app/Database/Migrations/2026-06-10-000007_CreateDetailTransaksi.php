<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_trans'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_prdk'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'qty'       => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'harga'     => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'sub_total' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_trans', 'transaksi', 'id_trans', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_prdk', 'produk', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_transaksi', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi', true);
    }
}
