<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $allowedFields = ['id', 'level_id', 'nim', 'nama', 'nohp', 'email', 'alamat', 'password', 'foto'];

    protected $DBGroup          = 'default';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nim' => [
            'rules' => 'required',
            'label' => 'NIM',
        ],
        'nama' => [
            'rules' => 'required',
            'label' => 'Nama',
        ],
        'nohp' => [
            'rules' => 'required',
            'label' => 'Nomor HP',
        ],
        'email' => [
            'rules' => 'required',
            'label' => 'Email',
        ],
        'alamat' => [
            'rules' => 'required',
            'label' => 'Alamat',
        ]
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
