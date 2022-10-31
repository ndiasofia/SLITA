<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MetodeSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('metode_pengambilan');

        $builder->insertBatch([
            [
                'id' => 1,
                'nama_metode' => 'Berkas Diambil di Fakultas'
            ],
            [
                'id' => 2,
                'nama_metode' => 'Berkas Dikirim'
            ],
        ]);
    }
}
