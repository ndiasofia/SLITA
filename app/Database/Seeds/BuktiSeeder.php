<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BuktiSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('bukti_pembayaran');

        $builder->insertBatch([
            [
                'id' => 1,
                'bukti_tf' => 'Sudah'
            ],
            [
                'id' => 2,
                'bukti_tf' => 'Belum'
            ],
        ]);
    }
}
