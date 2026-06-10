<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_stok'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_kategori' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_barang'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jml_stok'    => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_stok', true);
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'produk', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stok', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('stok', true);
    }
}
