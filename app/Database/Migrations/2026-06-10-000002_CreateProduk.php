<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_kategori' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_produk' => ['type' => 'VARCHAR', 'constraint' => 100],
            'harga'       => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'stok'        => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->createTable('produk', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('produk', true);
    }
}
