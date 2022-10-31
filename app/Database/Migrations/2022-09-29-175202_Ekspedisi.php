<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ekspedisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_ekspedisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kontak_ekspedisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('ekspedisi', true);
    }

    public function down()
    {
        $this->forge->dropTable('ekspedisi');
    }
}
