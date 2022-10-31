<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use CodeIgniter\API\ResponseTrait;
use \Config\Database;
use Hermawan\DataTables\DataTable;

class Alumni extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->db = Database::connect();
    }

    public function index()
    {
        if (session('level') == 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/data_alumni');
    }

    public function modal_detail($nim)
    {
        $data = $this->db->table('alumni a')
            ->join('pengguna p', 'p.nim=a.nim')
            ->where('a.nim', $nim)
            ->get()->getRowArray();

        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('data', $data)
            ->render('admin/components/detail_alumni');
        return $this->respond($response, 200);
    }

    public function datatable()
    {
        $builder = $this->db->table('pengguna')
            ->where('level_id', 1)
            ->orderBy('id', 'DESC');
        return DataTable::of($builder)->toJson(TRUE);
    }
}
