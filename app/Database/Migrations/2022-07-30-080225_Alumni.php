<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alumni extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_ijazah' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal_lulus' => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'tahun' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'ipk' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('nim', true);
        $this->forge->createTable('alumni');
    }

    public function down()
    {
        $this->forge->dropTable('alumni');
    }
}
