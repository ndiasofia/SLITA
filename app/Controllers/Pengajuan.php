<?php

namespace App\Controllers;

use \Config\Database;
use App\Models\AlumniModel;
use App\Models\PengajuanModel;
use App\Models\ModelPembayaran;
use App\Models\JenisBerkasModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Pengajuan extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->pengajuanModel = new PengajuanModel();
        $this->berkasModel = new JenisBerkasModel();
        $this->alumniModel = new AlumniModel();
        $this->pembayaranModel = new ModelPembayaran();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $method = $this->request->getServer('REQUEST_METHOD');
        if ($method === 'GET') {
            if (session('level') != 1) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data = [
                'berkas' => $this->berkasModel->findAll()
            ];
            return view('pengajuan/index', $data);
        } else if ($method === 'POST') {
            $berkas_1 = $this->request->getPost('jenis_berkas_1');            
            $berkas_2 = $this->request->getPost('jenis_berkas_2');            
            $berkas_3 = $this->request->getPost('jenis_berkas_3');  
            $kd_pengajuan = date("dmYHis");        
            $alamat = $this->request->getPost('alamat'); 
            $dta = [];            
            $biaya = 0;
            $nmBerkas = [];
            if ($berkas_1 != null) {
                array_push($nmBerkas,'Ijazah');
                $biaya += preg_replace("/[^0-9]/", "", $this->request->getPost('biaya_ijazah'));                
                $data_1 = [
                    'kode_pengajuan' => $kd_pengajuan,
                    'pengguna_id' => session("pengguna_id"),
                    'status_id' => 1,
                    'berkas_id' => 1,
                    'bukti_id' => 2,
                    'alamat' => $alamat,
                    'jumlah' => $this->request->getPost('jumlah_ijazah'),
                    'metode_pengambilan_id' => $this->request->getPost('metode_pengambilan'),
                    'biaya' => preg_replace("/[^0-9]/", "", $this->request->getPost('biaya_ijazah'))
                ];     
                if ($this->request->getPost('radio_berkas_ijazah') == '2') {
                    $data_1['nama_file'] = $this->request->getPost('new_berkas_ijazah');
                } else {
                    if (!$this->validate([                        
                        'jumlah_ijazah' => [
                            'rules' => 'required',
                        ],
                        'berkas_ijazah' => [
                            'rules' => 'uploaded[berkas_ijazah]'.'|mime_in[berkas_ijazah,application/pdf]|max_size[berkas_ijazah,2048]'
                        ],
                    ])) {
                        $response = [
                            'errors' => $this->validation->getErrors(),
                            'message' => 'Periksa kembali isian ijazah anda'
                        ];
                        return $this->respond($response, 422);
                    }
                    $nama_berkas = session('nim') . '_ijazah' . '.pdf';
    
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/berkas/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('berkas_ijazah')), FILE_USE_INCLUDE_PATH);
                    $data_1['nama_file'] = $nama_berkas;
                }          
                // $this->pengajuanModel->insert($data_1);    
                array_push($dta,$data_1);

            }

            if ($berkas_2 != null) {
                array_push($nmBerkas,'Transkrip');                
                $biaya += preg_replace("/[^0-9]/", "", $this->request->getPost('biaya_transkrip'));
                $data_2 = [
                    'kode_pengajuan' => $kd_pengajuan,
                    'pengguna_id' => session("pengguna_id"),
                    'status_id' => 1,
                    'berkas_id' => 2,
                    'bukti_id' => 2,
                    'alamat' => $alamat,
                    'jumlah' => $this->request->getPost('jumlah_transkrip'),
                    'metode_pengambilan_id' => $this->request->getPost('metode_pengambilan'),
                    'biaya' => preg_replace("/[^0-9]/", "", $this->request->getPost('biaya_transkrip'))
                ];     
                if ($this->request->getPost('radio_berkas_transkrip') == '2') {
                    $data_2['nama_file'] = $this->request->getPost('new_berkas_transkrip');
                } else {
                    if (!$this->validate([                        
                        'jumlah_transkrip' => [
                            'rules' => 'required',
                        ],
                        'berkas_transkrip' => [
                            'rules' => 'uploaded[berkas_transkrip]'.'|mime_in[berkas_transkrip,application/pdf]|max_size[berkas_transkrip,2048]'
                        ],
                    ])) {
                        $response = [
                            'errors' => $this->validation->getErrors(),
                            'message' => 'Periksa kembali isian ijazah anda'
                        ];
                        return $this->respond($response, 422);
                    }
                    $nama_berkas = session('nim') . '_transkrip' . '.pdf';
    
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/berkas/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('berkas_transkrip')), FILE_USE_INCLUDE_PATH);
                    $data_2['nama_file'] = $nama_berkas;
                }                
                array_push($dta,$data_2);                    
                // $this->pengajuanModel->insert($data_2);           
            }
            if ($berkas_3 != null) {
                array_push($nmBerkas, 'Akreditasi');
                $biaya += preg_replace("/[^0-9]/", "", $this->request->getPost('biaya_akreditasi'));
                $data_3 = [
                    'kode_pengajuan' => $kd_pengajuan,
                    'pengguna_id' => session("pengguna_id"),
                    'status_id' => 1,
                    'berkas_id' => 3,
                    'bukti_id' => 2,
                    'alamat' => $alamat,
                    'jumlah' => $this->request->getPost('jumlah_akreditasi'),
                    'metode_pengambilan_id' => $this->request->getPost('metode_pengambilan'),
                    'biaya' => preg_replace("/[^0-9]/", "", $this->request->getPost('biaya_akreditasi'))
                ];     
                if ($this->request->getPost('radio_berkas_akreditasi') == '2') {
                    $data_3['nama_file'] = $this->request->getPost('new_berkas_akreditasi');
                } else {
                    if (!$this->validate([                        
                        'jumlah_akreditasi' => [
                            'rules' => 'required',
                        ],
                        'berkas_akreditasi' => [
                            'rules' => 'uploaded[berkas_akreditasi]'.'|mime_in[berkas_akreditasi,application/pdf]|max_size[berkas_akreditasi,2048]'
                        ],
                    ])) {
                        $response = [
                            'errors' => $this->validation->getErrors(),
                            'message' => 'Periksa kembali isian ijazah anda'
                        ];
                        return $this->respond($response, 422);
                    }
                    $nama_berkas = session('nim') . '_akreditasi' . '.pdf';
    
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/berkas/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('berkas_akreditasi')), FILE_USE_INCLUDE_PATH);
                    $data_3['nama_file'] = $nama_berkas;
                }                
                array_push($dta,$data_3);                    
                // $this->pengajuanModel->insert($data_2);           
            }
            $this->pengajuanModel->insertBatch($dta);                           
            $keterangan = implode(',' , $nmBerkas);
            // Data pembayaran
            $data_alumni = $this->alumniModel->where('nim', session('nim'))->first();
            $data['pembayaran'] = [
                'nim' => session('nim'),
                'nama' => session('nama'),
                'kode_pengajuan' => $kd_pengajuan,
                'tahunlulusan' => date_format(date_create($data_alumni['tanggal_lulus']), "Y"),
                'prodi' => $data_alumni['jurusan'],
                'biaya' => $biaya,
                'tgl_tagihan' => date('Y-m-d'),
                'status_pembayaran' => 0,
                'ket_tagihan' => 'Tagihan Pengajuan Legalisir'
            ];
            $lastId = $this->pembayaranModel->where('nim', session('nim'))->orderBy('idPembayaran', 'desc')->first();
            if ($lastId) {
                $data['pembayaran']['idPembayaran'] = session('nim') . intval(str_replace(session('nim'), "", $lastId['idPembayaran']) + 1);
            } else {
                $data['pembayaran']['idPembayaran'] = session('nim') . '1';
            }
            $this->pembayaranModel->insert($data['pembayaran']);
            $this->pengajuanModel->where('kode_pengajuan',$kd_pengajuan)->set([
                'idPembayaran' => $data['pembayaran']['idPembayaran'],
                'keterangan_berkas' => $keterangan
            ])->update();
            $response = [
                'message' => 'Pengajuan Berhasil',
            ];

            return $this->respondCreated($response);
        }
    }

    public function pembayaran($kode_pengajuan)
    {
        $data = $this->db->table('pengajuan p')
            ->join('berkas b', 'p.berkas_id=b.id')
            ->join('status s', 'p.status_id=s.id')
            ->join('pengguna u', 'p.pengguna_id=u.id')
            ->join('alumni a', 'a.nim=u.nim')
            ->join('metode_pengambilan m', 'p.metode_pengambilan_id=m.id')
            ->where('p.kode_pengajuan', $kode_pengajuan)
            ->get()->getRowArray();

        return view('pengajuan/pembayaran', $data);
    }

    public function is_transkrip()
    {
        $transkrip = $this->pengajuanModel->where([
            'pengguna_id' => session('pengguna_id'),
            'berkas_id' => 2,
        ])->orderBy('kode_pengajuan', 'desc')->first();

        if ($transkrip) {
            $response = [
                'data' => $transkrip
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'message' => 'transkrip lama tidak ditemukan'
            ];
            return $this->respond($response, 404);
        }
    }
    public function is_akreditasi()
    {
        $akreditasi = $this->pengajuanModel->where([
            'pengguna_id' => session('pengguna_id'),
            'berkas_id' => 3,
        ])->orderBy('kode_pengajuan', 'desc')->first();

        if ($akreditasi) {
            $response = [
                'data' => $akreditasi
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'message' => 'akreditasi lama tidak ditemukan'
            ];
            return $this->respond($response, 404);
        }
    }

    public function is_ijazah()
    {
        $ijazah = $this->pengajuanModel->where([
            'pengguna_id' => session('pengguna_id'),
            'berkas_id' => 1,
        ])->orderBy('kode_pengajuan', 'desc')->first();

        if ($ijazah) {
            $response = [
                'data' => $ijazah
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'message' => 'ijazah lama tidak ditemukan'
            ];
            return $this->respond($response, 404);
        }
    }
    

    public function update_berkas($kode_pengajuan)
    {
        $berkas_1 = $this->request->getVar('berkas_1');
        $berkas_2 = $this->request->getVar('berkas_2');
        $berkas_3 = $this->request->getVar('berkas_3');

        if ($berkas_1 != null) {
            if (!$this->validate([                                        
                'berkas_ijazah' => [
                    'rules' => 'uploaded[berkas_ijazah]'.'|mime_in[berkas_ijazah,application/pdf]|max_size[berkas_ijazah,2048]'
                ],
            ])) {
                $response = [
                    'errors' => $this->validation->getErrors(),
                    'message' => 'Periksa kembali isian ijazah anda'
                ];
                return $this->respond($response, 422);
            }
            $nama_berkas = session('nim') . '_ijazah' . '.pdf';

            $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/berkas/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('berkas_ijazah')), FILE_USE_INCLUDE_PATH);
             $this->pengajuanModel->where(['kode_pengajuan' => $kode_pengajuan, 'berkas_id' => 1])->set([
                'nama_file' => $nama_berkas,
                'status_id' => 2
             ])->update();
        }  

        if ($berkas_2 != null) {              
            if (!$this->validate([                                        
                'berkas_transkrip' => [
                    'rules' => 'uploaded[berkas_transkrip]'.'|mime_in[berkas_transkrip,application/pdf]|max_size[berkas_transkrip,2048]'
                ],
            ])) {
                $response = [
                    'errors' => $this->validation->getErrors(),
                    'message' => 'Periksa kembali isian transkrip anda'
                ];
                return $this->respond($response, 422);
            }
            $nama_berkas = session('nim') . '_transkrip' . '.pdf';

            $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/berkas/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('berkas_transkrip')), FILE_USE_INCLUDE_PATH);
            $this->pengajuanModel->where(['kode_pengajuan' => $kode_pengajuan, 'berkas_id' => 2])->set([
                'nama_file' => $nama_berkas,
                'status_id' => 2,
             ])->update();            
        }

        if ($berkas_3 != null) {
            if (!$this->validate([                                        
                'berkas_akreditasi' => [
                    'rules' => 'uploaded[berkas_akreditasi]'.'|mime_in[berkas_akreditasi,application/pdf]|max_size[berkas_akreditasi,2048]'
                ],
            ])) {
                $response = [
                    'errors' => $this->validation->getErrors(),
                    'message' => 'Periksa kembali isian akreditasi anda'
                ];
                return $this->respond($response, 422);
            }
            $nama_berkas = session('nim') . '_akreditasi' . '.pdf';

            $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/berkas/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            file_put_contents($uploadDir . $nama_berkas, file_get_contents($this->request->getFile('berkas_akreditasi')), FILE_USE_INCLUDE_PATH);
            $this->pengajuanModel->where(['kode_pengajuan' => $kode_pengajuan, 'berkas_id' => 3])->set([
                'nama_file' => $nama_berkas,
                'status_id' => 2
             ])->update();       
        }
       
        $response = [
            'message' => 'File baru telah berhasil diupload'
        ];
        return $this->respond($response, 200);
    }

    public function upload_pembayaran($kode_pengajuan)
    {
        if (!$this->validate([
            'buktitf' => [
                'rules' => 'uploaded[buktitf]|mime_in[buktitf,image/jpg,image/jpeg,image/png]|max_size[buktitf,2048]'
            ],
        ])) {
            $response = [
                'errors' => $this->validation->getErrors(),
                'message' => 'bukti pembayaran tidak sesuai'
            ];
            return $this->respond($response, 422);
        }

        // $bukti_id = $this->pengajuanModel->where('kode_pengajuan', $kode_pengajuan)->first()['bukti_id'];
        $bukti_tf = session('nim') . '_' . $kode_pengajuan . '.jpg';

        $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/bukti_pembayaran/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        file_put_contents($uploadDir . $bukti_tf, file_get_contents($this->request->getFile('buktitf')), FILE_USE_INCLUDE_PATH);
        $data['nama_bukti_pembayaran'] = $bukti_tf;
        $data['status_id'] = 2;
        $data['bukti_id'] = 1;
        $this->pengajuanModel->where('kode_pengajuan',$kode_pengajuan)->set($data)->update();

        $response = [
            'message' => 'Bukti pembayaran telah berhasil diupload'
        ];
        return $this->respond($response, 200);
    }
}
