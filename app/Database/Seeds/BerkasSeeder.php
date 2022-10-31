<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BerkasSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('berkas');

        $builder->insertBatch([
            [
                'id' => 1,
                'nama_berkas' => 'Ijazah'
            ],
            [
                'id' => 2,
                'nama_berkas' => 'Transkrip'
            ],
            [
                'id' => 3,
                'nama_berkas' => 'Akreditasi'
            ],            
        ]);
    }
}
