<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('status');

        $builder->insertBatch([
            [
                'id' => 1,
                'nama_status' => 'Menunggu Pembayaran'
            ],
            [
                'id' => 2,
                'nama_status' => 'Sedang Diverifikasi'
            ],
            [
                'id' => 3,
                'nama_status' => 'Ditolak, Masukkan Ulang Dokumen'
            ],
            [
                'id' => 4,
                'nama_status' => 'Dalam Proses Pembuatan'
            ],
            [
                'id' => 5,
                'nama_status' => 'Selesai'
            ],
            [
                'id' => 6,
                'nama_status' => 'Dibatalkan Otomatis'
            ],
            [
                'id' => 7,
                'nama_status' => 'Dalam Proses Pengiriman'
            ],
        ]);
    }
}
