<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use App\Models\AlumniModel;
use CodeIgniter\API\ResponseTrait;
use \Config\Database;

class Importer extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->alumniModel = new AlumniModel();
    }

    public function index()
    {
        return view('importer/index');
    }

    public function import_excel()
    {
        $file_excel = $this->request->getFile('file');
        $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        if ($file_excel == '') {
            $response = ['message' => 'Harap masukkan file'];
            return $this->respond($response, 422);
        }
        $spreadsheet = $render->load($file_excel);
        $data_excel = $spreadsheet->getActiveSheet()->toArray();

        for ($i = 0; $i < count($data_excel); $i++) {
            $data_excel[$i]['nama'] = trim(strtoupper($data_excel[$i][0]));
            $data_excel[$i]['nim'] = preg_replace('/[^0-9]/', '', $data_excel[$i][1]);
            $data_excel[$i]['jurusan'] = $data_excel[$i][2];
            if ($data_excel[$i][3]) {
                $data_excel[$i]['no_ijazah'] = preg_replace('/\s+/', '', $data_excel[$i][3]);
            } else {
                $data_excel[$i]['no_ijazah'] = null;
            }
            $data_excel[$i]['tanggal_lulus'] = $data_excel[$i][4];
            $data_excel[$i]['tahun'] = $data_excel[$i][5];
            $data_excel[$i]['ipk'] = $data_excel[$i][6];
            unset($data_excel[$i][0]);
            unset($data_excel[$i][1]);
            unset($data_excel[$i][2]);
            unset($data_excel[$i][3]);
            unset($data_excel[$i][4]);
            unset($data_excel[$i][5]);
            unset($data_excel[$i][6]);
        }

        $this->alumniModel->insertBatch($data_excel, true);

        $response = ['message' => 'Berhasil import data alumni'];

        return $this->respond($response, 200);
    }
}
