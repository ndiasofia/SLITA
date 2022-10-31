<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Pembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idPembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kode_pengajuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tahunlulusan' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'biaya' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tgl_tagihan' => [
                'type' => 'DATE',
            ],
            'status_pembayaran' => [
                'type' => 'BOOLEAN',
            ],
            'tgl_pembayaran' => [
                'type' => 'DATE',
            ],
            'jumlah_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'idTransaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kodeChannel' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'reversal' => [
                'type' => 'BOOLEAN',
            ],
            'kodebank' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ket_tagihan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('idPembayaran', true);
        $this->forge->createTable('pembayaran', true);
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
