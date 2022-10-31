<?php

namespace App\Controllers;

use \Config\Database;
use App\Models\AlumniModel;
use App\Models\PenggunaModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Beranda extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->penggunaModel = new PenggunaModel();
        $this->alumniModel = new AlumniModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session('level') != 1) {
            return redirect()->to('/legalisir');
        }
        // Untuk ambil data di tabel pengguna dengan nim yang sedang login
        $pengguna = $this->penggunaModel->where('nim', session('nim'))->first();

        // Untuk ambil data di tabel alumni dengan nim yang sedang login
        $alumni = $this->alumniModel->where('nim', session('nim'))->first();

        $data['pengguna'] = array_merge($pengguna, $alumni);
        return view('beranda/index', $data);
    }

    public function update_profil()
    {
        $data = [
            'nohp' => $this->request->getPost('nohp'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $this->penggunaModel->update(session('pengguna_id'), $data);

        $response = [
            'message' => 'Data Profil Alumni Berhasil Diubah',
            'data' =>  $this->penggunaModel->find(session('pengguna_id'))
        ];

        return $this->respond($response, 200);
    }

    public function upload_foto()
    {
        if (!$this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]'
            ],
        ])) {
            $response = [
                'errors' => $this->validation->getErrors(),
                'message' => 'periksa kembali isian anda'
            ];
            return $this->respond($response, 422);
        }
        $nama_berkas = session('nim') . '.jpg';

        $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/foto/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $oldFoto = $this->penggunaModel->find(session('pengguna_id'))['foto'];
        $oldFoto = $uploadDir . ($oldFoto ? $oldFoto : 'null.jpg');
        if (is_writable($oldFoto)) {
            unlink($oldFoto);
        }
        file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('foto')), FILE_USE_INCLUDE_PATH);
        $data['foto'] = $nama_berkas;

        $this->penggunaModel->update(session('pengguna_id'), $data);

        $response = [
            'message' => 'Upload Foto Berhasil',
            'data' =>  $this->penggunaModel->find(session('pengguna_id'))
        ];

        return $this->respond($response);
    }

    public function modal_ubah_password()
    {
        $view = \Config\Services::renderer();
        $response['html'] = $view->render('beranda/components/modal_ubah_password');
        return $this->respond($response);
    }

    public function update_password()
    {
        $data=[
            'password' => $this->request->getPost('password'),
        ];
        $konfirmasi = $this->request->getPost('konfirmasi');
        if (!$this->validate([
            'password' => [
                'rules' => 'required',
            ],
            'konfirmasi' => [
                'rules' => 'required|matches[password]',
            ]
        ])) {
            $response = ['message' => 'Periksa kembali isian anda'];
            return $this->respond($response, 422);
        }

        if ($data['password'] != $konfirmasi) {
            $response = [
                'message' => 'Password tidak sama'
            ];

            return $this->respond($response, 422);
        }

        if(!$this->penggunaModel->update(session('pengguna_id'), $data)) {
            $response = [
                'message' => 'Gagal mengubah password'
            ];

            return $this->respond($response, 422);
        }

        helper('mailer');
        $pengguna = $this->penggunaModel->find(session('pengguna_id'));
        $email = session('email');
        $view = \Config\Services::renderer();
        $message = $view->setVar('data', $pengguna)
            ->render('mailer/data_user');

        sendmail($email, "Data Akun SLIT FMIPA USK", $message);

        $response = [
            'message' => 'Berhasil mengirim data perubahan password ke email'
        ];

        return $this->respond($response);
    }
}
