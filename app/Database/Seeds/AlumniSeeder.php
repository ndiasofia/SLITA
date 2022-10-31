<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlumniSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('alumni');

        $builder->insertBatch([
            [
                'nim' => 11111,
                'nama' => 'Mamang',
                'jurusan' => 'Teknik Informatika',
                'no_ijazah' => '12345',
                'tanggal_lulus' => '2021-10-09',
                'tahun' => '2021',
                'ipk' => '3,5',
            ],                                 
        ]);
    }
}
