<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_user' => ['type' => 'VARCHAR', 'constraint' => 100],
            'username'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'hak_akses' => ['type' => 'ENUM', 'constraint' => ['owner', 'kasir'], 'default' => 'kasir'],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('user', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('user', true);
    }
}
