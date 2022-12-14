<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MetodePengambilan extends Migration
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
            'nama_metode' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('metode_pengambilan', true);

        $seeder = \Config\Database::seeder();
        $seeder->call('MetodeSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('metode_pengambilan');
    }
}
