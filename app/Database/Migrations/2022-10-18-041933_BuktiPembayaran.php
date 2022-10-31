<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuktiPembayaran extends Migration
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
            'bukti_tf' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bukti_pembayaran', true);

        $seeder = \Config\Database::seeder();
        $seeder->call('BuktiSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('bukti_pembayaran');
    }
}
