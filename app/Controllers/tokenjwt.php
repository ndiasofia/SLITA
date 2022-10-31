<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPembayaran;
use \Config\Database;
use \Hermawan\DataTables\DataTable;

class tokenjwt extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->session = \Config\Services::session();
        $this->ModelPembayaran = new ModelPembayaran();
    }

    public function index()
    {
        return view('pembayaran/tokenjwt');
    }

    public function modal_token()
    {
        $view = \Config\Services::renderer();
        $response['html'] = $view->render('pembayaran/components/genToken');
        return $this->respond($response, 200);
    }

    public function generateToken()
    {
        $codeBank = $this->request->getPost('kodebank');
        $nameBank = $this->request->getPost('namabank');

        helper('jwt');
        $access_token = createJWT($codeBank, $nameBank);
        $response = [
            'message' => 'Generate Token Berhasil',
            'access_token' => $access_token,
        ];

        return $this->respond($response);
    }
}
