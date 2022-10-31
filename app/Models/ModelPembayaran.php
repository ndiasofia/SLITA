<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPembayaran extends Model
{
    protected $DBGroup          = 'default';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'idPembayaran';
    protected $allowedFields    = ['idPembayaran', 'nim', 'nama', 'tahunlulusan', 'biaya', 'kode_pengajuan', 'catatan', 'tgl_tagihan', 'status_pembayaran', 'tgl_pembayaran', 'jumlah_pembayaran', 'idTransaksi', 'kodeChannel', 'reversal', 'kodebank', 'ket_tagihan'];

    //Validasi
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Tanggal
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
