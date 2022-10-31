<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeColumnNamaEkspedisi extends Migration
{
    public function up()
    {
        $fields = [
            'nama_ekspedisi' => [
                'name' => 'ekspedisi_id',
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
        ];
        $forge = \Config\Database::forge();
        $forge->modifyColumn('pengajuan', $fields);
    }

    public function down()
    {
        $fields = [
            'ekspedisi_id' => [
                'name' => 'nama_ekspedisi',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ];
        $forge = \Config\Database::forge();
        $forge->modifyColumn('pengajuan', $fields);
    }
}
