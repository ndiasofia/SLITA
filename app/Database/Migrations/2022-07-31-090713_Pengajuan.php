<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Pengajuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengajuan' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'kode_pengajuan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'idPembayaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'pengguna_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'status_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'berkas_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'keterangan_berkas' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'bukti_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'metode_pengambilan_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'biaya' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nama_file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_bukti_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'nama_ekspedisi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'no_resi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal_selesai' => [
                'type'    => 'DATETIME',
                'null' => true,
            ],

            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id_pengajuan', true);
        $this->forge->addForeignKey('pengguna_id', 'pengguna', 'id');
        $this->forge->addForeignKey('status_id', 'status', 'id');
        $this->forge->addForeignKey('berkas_id', 'berkas', 'id');
        $this->forge->addForeignKey('metode_pengambilan_id', 'metode_pengambilan', 'id');
        $this->forge->createTable('pengajuan', true);
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan');
    }
}
