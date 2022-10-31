<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use \Config\Database;
use App\Models\PenggunaModel;
use App\Models\AlumniModel;


class Auth extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->alumniModel = new AlumniModel();
        $this->db = Database::connect();
    }

    public function masuk()
    {
        $method = $this->request->getServer('REQUEST_METHOD');
        if ($method === 'GET') {
            if (session('isLoggedIn') == TRUE) {
                return redirect()->to('/');
            }
            return view('auth/masuk');
        } else if ($method === 'POST') {
            $data = [
                'nim' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password')
            ];

            if (!$this->validate([
                'username' => [
                    'rules' => 'required',
                ],
                'password' => [
                    'rules' => 'required',
                ]
            ])) {
                $response = ['message' => 'Tidak boleh kosong'];
                return $this->respond($response, 422);
            }

            $pengguna = $this->penggunaModel->where('nim', $data['nim'])->first();
            if (!$pengguna) {
                $response = ['message' => 'Pengguna belum terdaftar'];
                return $this->respond($response, 422);
            }

            if (!password_verify($data['password'], $pengguna['password'])) {
                $response = ['message' => 'Password Salah'];
                return $this->respond($response, 422);
            }

            session()->set([
                'isLoggedIn' => TRUE,
                'nim' => $pengguna['nim'],
                'pengguna_id' => $pengguna['id'],
                'nama' => $pengguna['nama'],
                'email' => $pengguna['email'],
                'level' => $pengguna['level_id']
            ]);

            // Tampilkan halaman sesuai role
            if ($pengguna['level_id'] == 1) {
                $redirect = 'beranda';
            } else if ($pengguna['level_id'] == 2) {
                $redirect = 'legalisir';
            } else if ($pengguna['level_id'] == 3) {
                $redirect = 'pembayaran';
            }

            $response = [
                'message' => 'Berhasil Login',
                'redirect' => $redirect
            ];
            return $this->respond($response, 200);
        }
    }

    public function verifikasi()
    {
        $method = $this->request->getServer('REQUEST_METHOD');
        if ($method === 'GET') {
            if (session('isLoggedIn') == TRUE) {
                return redirect()->to('/');
            }
            return view('auth/verifikasi');
        } else if ($method === 'POST') {
            $data = [
                'nim' => $this->request->getPost('nim'),
                'tahun' => $this->request->getPost('tahun')
            ];

            if (!$this->validate([
                'nim' => [
                    'rules' => 'required',
                ],
                'tahun' => [
                    'rules' => 'required',
                ]
            ])) {
                $response = ['message' => 'Tidak boleh kosong'];
                return $this->respond($response, 422);
            }

            $alumni = $this->alumniModel->where(['nim' => $data['nim'], 'tahun' => $data['tahun']])->first();
            if (!$alumni) {
                $response = ['message' => 'NIM atau Tahun Lulus tidak ditemukan'];
                return $this->respond($response, 422);
            }

            $pengguna = $this->penggunaModel->where('nim', $data['nim'])->first();
            if ($pengguna) {
                $response = ['message' => 'NIM sudah terdaftar'];
                return $this->respond($response, 422);
            }

            session()->set([
                'isVerification' => TRUE,
                'nim' => $alumni['nim'],
                'nama' => $alumni['nama']
            ]);

            $response = [
                'message' => 'NIM dan Tahun Lulus berhasil diverifikasi'
            ];
            return $this->respond($response, 200);
        }
    }

    public function daftar()
    {
        $method = $this->request->getServer('REQUEST_METHOD');
        if ($method === 'GET') {
            if (session("isVerification") == FALSE) {
                return redirect()->to("verifikasi");
            }
            if (session('isLoggedIn') == TRUE) {
                return redirect()->to('/');
            }
            return view('auth/daftar');
        } else if ($method === 'POST') {
            $data = [
                'nim' => $this->request->getPost('nim'),
                'level_id' => '1',
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'alamat' => $this->request->getPost('alamat'),
                'nohp' => $this->request->getPost('nohp'),
                'password' => $this->request->getPost('password'),
            ];
            $konfirmasi = $this->request->getPost('konfirmasi');
            if ($data['password'] != $konfirmasi) {
                $response = [
                    'message' => 'Password tidak sama'
                ];

                return $this->respond($response, 422);
            }
            
            $cekemail = $this->penggunaModel->where('email', $data['email'])->first();
            if ($cekemail) {
                $response = [
                    'message' => 'email sudah terdaftar'
                ];

                return $this->respond($response, 422);
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $id = $this->penggunaModel->insert($data, true);
            $errors = $this->penggunaModel->errors();
            $statusCode = count($errors) ? 422 : 200;

            if (count($errors)) {
                $response = [
                    'message' => 'Tidak boleh ada yang kosong',
                    'errors' => $errors
                ];
                $statusCode = 422;
                return $this->respond($response, $statusCode);
            } else {
                helper('mailer');
                $view = \Config\Services::renderer();
                $message = $view->setVar('data', $data)
                    ->render('mailer/pendaftaran');

                sendmail($data['email'], "Pendaftaran Akun SLIT FMIPA USK", $message);

                $response = [
                    'message' => 'Berhasil daftar, silahkan login',
                    'data' =>  $this->penggunaModel->find($id)
                ];

                return $this->respondCreated($response);
            }
        }
    }

    public function reset_password()
    {
        $method = $this->request->getServer('REQUEST_METHOD');
        if ($method === 'GET') {
            if (session('isLoggedIn') == TRUE) {
                return redirect()->to('/');
            }
            return view('auth/reset_password_email');
        } else if ($method === 'POST') {
            $data = [
                'email' => $this->request->getPost('email'),
            ];

            if (!$this->validate([
                'email' => [
                    'rules' => 'required',
                ]
            ])) {
                $response = ['message' => 'Tidak boleh kosong'];
                return $this->respond($response, 422);
            }

            $pengguna = $this->penggunaModel->where('email', $data['email'])->first();
            if (!$pengguna) {
                $response = ['message' => 'Email tidak ditemukan'];
                return $this->respond($response, 422);
            } 

            helper('mailer');

                $key = uniqid();
                $this->db->query("update pengguna set `reset_key` = '$key' where `email` = '". $data['email']."'");
                $pengguna['key'] = $key;
                $view = \Config\Services::renderer();
                $message = $view->setVar('data', $pengguna)
                    ->render('mailer/data_user');

                sendmail($data['email'], "Data Akun SLIT FMIPA USK", $message);

                $response = [
                    'message' => 'Berhasil mengirim data ke email',
                ];

                return $this->respondCreated($response);
        }
    } 
    
    public function reset($key = "")
    {

        $method = $this->request->getServer('REQUEST_METHOD');

        if ($method === 'GET') {

            $pengguna = $this->penggunaModel->where('reset_key', $key)->first();
            if(is_null($pengguna)){
                return redirect()->to('/');
            }
            if (session('isLoggedIn') == TRUE) {
                return redirect()->to('/');
            }
            $data['reset_key'] = $key;
            return view('auth/reset', $data );
        } else if ($method === 'POST') {
            $data=[
                'password' => $this->request->getPost('password'),
                'key' => $this->request->getPost('key'),
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
            
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $upd = $this->db->query("update pengguna set `password` = '".$data['password']."', `reset_key` = NULL where `reset_key` = '". $data['key']."'");

            if(!$upd) {
                $response = [
                    'message' => 'Gagal mengubah password'
                ];
    
                return $this->respond($response, 422);
            }
    
            $response = [
                'message' => 'Berhasil mengubah password'
            ];
    
            return $this->respond($response, 200);
        }

    }

    // public function update_password()
    // {
    //     $method = $this->request->getServer('REQUEST_METHOD');
    //     if ($method === 'GET') {
    //         if (session('isLoggedIn') == TRUE) {
    //             return redirect()->to('/');
    //         }
    //         return view('auth/reset');
    //     } else if ($method === 'POST') {
    //         $data=[
    //             'password' => $this->request->getPost('password'),
    //         ];
    //         $konfirmasi = $this->request->getPost('konfirmasi');
    //         if (!$this->validate([
    //             'password' => [
    //                 'rules' => 'required',
    //             ],
    //             'konfirmasi' => [
    //                 'rules' => 'required|matches[password]',
    //             ]
    //         ])) {
    //             $response = ['message' => 'Periksa kembali isian anda'];
    //             return $this->respond($response, 422);
    //         }
    
    //         if ($data['password'] != $konfirmasi) {
    //             $response = [
    //                 'message' => 'Password tidak sama'
    //             ];
    
    //             return $this->respond($response, 422);
    //         }
    
    //         if(!$this->penggunaModel->update('pengguna', $data)) {
    //             $response = [
    //                 'message' => 'Gagal mengubah password'
    //             ];
    
    //             return $this->respond($response, 422);
    //         }
    
    //         helper('mailer');
    //         $pengguna = $this->penggunaModel->find($id);
    //         $email = session('email');
    //         $view = \Config\Services::renderer();
    //         $message = $view->setVar('data', $pengguna)
    //             ->render('mailer/data_user');
    
    //         sendmail($email, "Data Akun SLIT FMIPA USK", $message);
    
    //         $response = [
    //             'message' => 'Berhasil mengirim data perubahan password ke email'
    //         ];
    
    //         return $this->respond($response, 200);
    //     }


        
    // }


    public function keluar()
    {
        $this->session->destroy();
        return redirect()->to('/masuk');
    }
}
