<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use \Config\Database;
use App\Models\EkspedisiModel;
use Hermawan\DataTables\DataTable;

class Ekspedisi extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->ekspedisiModel = new EkspedisiModel();
    }

    public function index()
    {
        if (session('level') == 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('ekspedisi/index');
    }

    public function modal_create()
    {
        $view = \Config\Services::renderer();
        $response['html'] = $view->render('ekspedisi/components/modal_create');
        return $this->respond($response, 200);
    }

    public function modal_update($id)
    {
        $data = $this->ekspedisiModel->find($id);
        $view = \Config\Services::renderer();
        $response['html'] = $view->setData($data)->setVar('id', $id)
            ->render('ekspedisi/components/modal_update');
        return $this->respond($response, 200);
    }

    public function modal_delete($id)
    {
        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('id', $id)
            ->render('ekspedisi/components/modal_delete');
        return $this->respond($response, 200);
    }

    public function store()
    {
        $data = [
            'nama_ekspedisi' => $this->request->getPost('nama_ekspedisi'),
            'kontak_ekspedisi' => $this->request->getPost('kontak_ekspedisi') != '' ? $this->request->getPost('kontak_ekspedisi') : '-',
        ];

        $id = $this->ekspedisiModel->insert($data, true);

        $errors = $this->ekspedisiModel->errors();
        $statusCode = count($errors) ? 422 : 200;

        if (count($errors)) {
            $response = [
                'message' => 'validasi gagal',
                'errors' => $errors
            ];
            $statusCode = 422;
            return $this->respond($response, $statusCode);
        } else {
            $response = [
                'data' => $this->ekspedisiModel->find($id),
                'message' => 'Berhasil Menambahkan Data Ekspedisi'
            ];
            return $this->respondCreated($response);
        }
    }

    public function update($id)
    {
        $data = [
            'nama_ekspedisi' => $this->request->getPost('nama_ekspedisi'),
            'kontak_ekspedisi' => $this->request->getPost('kontak_ekspedisi'),
        ];

        if ($this->ekspedisiModel->update($id, $data) === FALSE) return $this->failValidationErrors($this->ekspedisiModel->errors());

        $response = [
            'data' => $this->ekspedisiModel->find($id),
            'message' => 'Berhasil Mengubah Data Ekspedisi',
        ];
        return $this->respond($response);
    }

    public function delete($id)
    {
        try {
            $this->ekspedisiModel->delete($id);
            $delete = $this->db->affectedRows() === 1;

            if ($delete) {
                $response['message'] = 'Berhasil Menghapus Ekspedisi';
                $statusCode = 200;
            } else {
                $response['status'] = FALSE;
                $response['message'] = 'Ekspedisi Tidak Ada';
                $statusCode = 400;
            }
        } catch (\Exception $e) {
            $response['message'] = "Caught exception: " . $e->getMessage() . "\n";
            $statusCode = 500;
        }

        return $this->respond($response, $statusCode);
    }

    public function datatable()
    {
        $builder = $this->db->table('ekspedisi')->orderBy('nama_ekspedisi', 'asc');

        return DataTable::of($builder)->toJson(TRUE);
    }
}
