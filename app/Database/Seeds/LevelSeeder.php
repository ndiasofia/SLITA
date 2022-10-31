<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('level');

        $builder->insertBatch([
            [
                'id' => 1,
                'nama_level' => 'Alumni'
            ],
            [
                'id' => 2,
                'nama_level' => 'Verifikator'
            ],
            [
                'id' => 3,
                'nama_level' => 'Dekanan'
            ],
        ]);
    }
}
