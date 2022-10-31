<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pengguna');

        $builder->insertBatch([
            [
                'id' => 1,
                'level_id' => 1,
                'nim' => '11111',
                'nama' => 'Alumni',
                'nohp' => '088899991111',
                'email' => 'tes@gmail.com',
                'alamat' => 'Jakarta',
                'password' => password_hash('12345', PASSWORD_DEFAULT),                
            ],
            [
                'id' => 2,
                'level_id' => 2,
                'nim' => '22222',
                'nama' => 'Verifikator',
                'nohp' => '088899991111',
                'email' => 'tes@gmail.com',
                'alamat' => 'Jakarta',
                'password' => password_hash('12345', PASSWORD_DEFAULT),                
            ],
            [
                'id' => 3,
                'level_id' => 3,
                'nim' => '33333',
                'nama' => 'Dekanan',
                'nohp' => '088899991111',
                'email' => 'tes@gmail.com',
                'alamat' => 'Jakarta',
                'password' => password_hash('12345', PASSWORD_DEFAULT),                
            ],
        ]);
    }
}
