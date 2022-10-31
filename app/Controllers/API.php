<?php

namespace App\Controllers;

use \Config\Database;
use App\Controllers\BaseController;
use App\Models\JenisBerkasModel;
use App\Models\ModelPembayaran;
use App\Models\PengajuanModel;
use App\Models\PenggunaModel;
use CodeIgniter\API\ResponseTrait;

class API extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->ModelPembayaran = new ModelPembayaran();
        $this->PenggunaModel = new PenggunaModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->pengajuanModel = new PengajuanModel();
        $this->berkasModel = new JenisBerkasModel();
    }

    public function index()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $rules = [
            'action' => [
                'rules' => 'required',
                'label' => 'Action',
            ],
            'kodeBank' => [
                'rules' => 'required',
                'label' => 'Kode Bank',
            ],
            'kodeBiller' => [
                'rules' => 'required',
                'label' => 'Kode Biller',
            ],
            'kodeChannel' => [
                'rules' => 'required',
                'label' => 'Kode Channel',
            ],
            'kodeTerminal' => [
                'rules' => 'required',
                'label' => 'Kode Terminal',
            ],
            'nomorPembayaran' => [
                'rules' => 'required',
                'label' => 'Nomor Pembayaran',
            ],
            'tanggalTransaksi' => [
                'rules' => 'required',
                'label' => 'Tanggal Transaksi',
            ],
            'idTransaksi' => [
                'rules' => 'required',
                'label' => 'Id Transaksi',
            ],
        ];

        switch ($data['action']) {
            case "inquiry":
                return $this->inquiry($data, $rules);
                break;
            case "payment":
                return $this->payment($data, $rules);
                break;
            case "reversal":
                return $this->reversal($data, $rules);
                break;
            default:
                $response = [
                    'rc' => '30',
                    'msg' => 'action tidak tersedia',
                ];
                return $this->respond($response);
        }
    }

    public function inquiry($data, $rules)
    {
        if (!($this->validate($rules))) {
            $response = [
                'rc' => '30',
                'msg' => 'periksa kembali isian anda',
                'errors' => $this->validation->getErrors(),
            ];
        } else {
            $pembayaran = $this->ModelPembayaran->where('nim', $data['nomorPembayaran'])->orderBy('status_pembayaran', 'asc')->first();
            
            if ($pembayaran) {
                if ($pembayaran['status_pembayaran'] == 0) {
                    $nama_berkas = $this->db->table('pembayaran p')
                        ->join('berkas u', 'p.berkas_id=u.id')
                        ->where('p.idPembayaran', $pembayaran['idPembayaran'])
                        ->select('
                        p.nama,
                        u.nama_berkas                         
                    ')
                        ->get()->getRowArray();
                    $response = [
                        'rc' => '00',
                        'msg' => 'Inquiry berhasil',
                        'nomorPembayaran' => $pembayaran['nim'],
                        'idPelanggan' => $pembayaran['nim'],
                        'idPembayaran' => $pembayaran['idPembayaran'],
                        'nama' => $pembayaran['nama'],
                        'informasi' => [
                            'NIM' => $pembayaran['nim'],
                            'TAHUN LULUS' => $pembayaran['tahunlulusan'],
                            'BERKAS' => $nama_berkas['nama_berkas'],
                        ],
                        'rincian' => [],
                        'totalNominal' => $pembayaran['biaya'],
                    ];
                } else {
                    $response = [
                        'rc' => '88',
                        'msg' => 'Tagihan sudah terbayar',
                    ];
                }
            } else {
                $response = [
                    'rc' => '14',
                    'msg' => 'Nomor Identitas Pembayaran tidak ditemukan',
                ];
            }
        }
        return $this->respond($response);
    }

    public function payment($data, $rules)
    {
        $addRules = [
            'idPembayaran' => [
                'rules' => 'required',
                'label' => 'Id Pembayaran',
            ],
            'totalNominal' => [
                'rules' => 'required',
                'label' => 'Total Nominal',
            ],
            'nomorJurnalPembukuan' => [
                'rules' => 'required',
                'label' => 'Nomor Jurnal Pembukuan',
            ],
        ];

        $paymentRules = array_merge($rules, $addRules);
        if (!($this->validate($paymentRules))) {
            $response = [
                'rc' => '30',
                'msg' => 'periksa kembali isian anda',
                'errors' => $this->validation->getErrors(),
            ];
        } else {
            $pembayaran = $this->ModelPembayaran->where([
                'nim' => $data['nomorPembayaran'],
            ])->findAll();

            if ($pembayaran) {
                $pembayaran = $this->ModelPembayaran->where([
                    'nim' => $data['nomorPembayaran'],
                    'idPembayaran' => $data['idPembayaran'],
                ])->first();

                if (!$pembayaran) {
                    $response = [
                        'rc' => '01',
                        'msg' => 'Identitas pembayar ditemukan namun id Pembayaran tidak ditemukan',
                    ];
                } else if ($pembayaran['biaya'] != $data['totalNominal']) {
                    $response = [
                        'rc' => '13',
                        'msg' => 'Nilai Pembayaran salah',
                    ];
                } else if ($pembayaran['status_pembayaran'] == 1) {
                    $response = [
                        'rc' => '88',
                        'msg' => 'Tagihan sudah dibayar',
                    ];
                } else {
                    $data = [
                        'idPembayaran' => $data['idPembayaran'],
                        'nim' => $data['nomorPembayaran'],
                        'status_pembayaran' => 1,
                        'reversal' => 0,
                        'tgl_pembayaran' => date("Y-m-d H:i:s"),
                        'jumlah_pembayaran' => $data['totalNominal'],
                        'idTransaksi' => $data['idTransaksi'],
                        'kodeChannel' => $data['kodeChannel'],
                        'kodebank' => $this->session->get('codeBank'),
                        'ket_pembayaran' => "Sudah Melakukan Pembayaran Melalui " . $this->session->get('nameBank'),
                    ];
                    $pengajuan = ["status_id" => "2"];
                    $this->pengajuanModel->where('idPembayaran', $data["idPembayaran"])->set($pengajuan)->update();

                    helper('mailer');
                    $idPembayaran = $data['idPembayaran'];
                    $npembayaran = $this->db->table('pembayaran p')
                        ->join('pengajuan q', 'q.idPembayaran = p.idPembayaran')
                        ->join('status s', 'q.status_id=s.id')
                        ->join('berkas u', 'q.berkas_id=u.id')
                        ->where('p.idPembayaran', $idPembayaran)
                        ->select('
                        p.nama,
                        u.nama_berkas,
                        p.idPembayaran,
                        s.nama_status                            
                    ')
                        ->get()->getRowArray();

                    $view = \Config\Services::renderer();
                    $message = $view->setVar('npembayaran', $npembayaran)
                        ->render('mailer/pembayaran');
                    $email = $this->db->table('pengajuan p')
                        ->join('pengguna u ', 'p.pengguna_id=u.id')
                        ->where('p.idPembayaran', $idPembayaran)
                        ->select('u.email')
                        ->get()->getRowArray();
                    sendmail($email, "Pembayaran Pengajuan Legalisir SLIT FMIPA USK", $message);

                    if (!$this->ModelPembayaran->where(['idPembayaran' => $data['idPembayaran'], 'nim' => $data['nim']])->set($data)->update()) {
                        $response = [
                            'rc' => '91',
                            'msg' => 'Database Problem',
                        ];
                    } else {
                        $pembayaran = $this->ModelPembayaran->find($data['idPembayaran']);
                        $nama_berkas = $this->db->table('pembayaran p')
                        ->join('berkas u', 'p.berkas_id=u.id')
                        ->where('p.idPembayaran', $pembayaran['idPembayaran'])
                        ->select('
                        p.nama,
                        u.nama_berkas                         
                    ')
                        ->get()->getRowArray();
                        $response = [
                            'rc' => '00',
                            'msg' => 'Payment berhasil',
                            'nomorPembayaran' => $pembayaran['nim'],
                            'idPelanggan' => $pembayaran['nim'],
                            'idPembayaran' => $pembayaran['idPembayaran'],
                            'nama' => $pembayaran['nama'],
                            'informasi' => [
                                'NIM' => $pembayaran['nim'],
                                'TAHUN LULUSAN' => $pembayaran['tahunlulusan'],
                                'BERKAS' => $nama_berkas['nama_berkas'],
                            ],
                            'rincian' => [],
                            'totalNominal' => $pembayaran['biaya'],
                        ];
                    }
                }
            } else {
                $response = [
                    'rc' => '14',
                    'msg' => 'Nomor Identitas Pembayaran tidak ditemukan',
                ];
            }
        }
        return $this->respond($response);
    }

    public function reversal($data, $rules)
    {
        $addRules = [
            'tanggalTransaksiAsal' => [
                'rules' => 'required',
                'label' => 'Tanggal Transaksi Asal',
            ],
            'idPembayaran' => [
                'rules' => 'required',
                'label' => 'Id Pembayaran',
            ],
            'totalNominal' => [
                'rules' => 'required',
                'label' => 'Total Nominal',
            ],
            'nomorJurnalPembukuan' => [
                'rules' => 'required',
                'label' => 'Nomor Jurnal Pembukuan',
            ],
        ];
        $reversalRules = array_merge($rules, $addRules);
        if (!($this->validate($reversalRules))) {
            $response = [
                'rc' => '30',
                'msg' => 'periksa kembali isian anda',
                'errors' => $this->validation->getErrors(),
            ];
        } else {
            $pembayaran = $this->ModelPembayaran->where([
                'nim' => $data['nomorPembayaran'],
            ])->findAll();

            if ($pembayaran) {
                $pembayaran = $this->ModelPembayaran->where([
                    'nim' => $data['nomorPembayaran'],
                    'idPembayaran' => $data['idPembayaran']
                ])->first();

                if ($pembayaran['reversal'] == 1) {
                    $response = [
                        'rc' => '94',
                        'msg' => 'Telah berhasil dilakukan reversal sebelumnya',
                    ];
                } else {
                    $pembayaran = $this->ModelPembayaran->where([
                        'nim' => $data['nomorPembayaran'],
                        'idPembayaran' => $data['idPembayaran'],
                        'idTransaksi' => $data['idTransaksi']
                    ])->first();

                    if (!$pembayaran) {
                        $response = [
                            'rc' => '01',
                            'msg' => 'Nomor pembayaran ditemukan namun id pembayaran / id transaksi tidak ditemukan',
                        ];
                    } else if ($pembayaran['kodebank'] != $this->session->get('codeBank')) {
                        $response = [
                            'rc' => '05',
                            'msg' => 'Hanya Bank yang melakukan payment yang dapat melakukan reversal',
                        ];
                    } else if ($pembayaran['status_pembayaran'] == 0 && $pembayaran['reversal'] == 0) {
                        $response = [
                            'rc' => '63',
                            'msg' => 'Transaksi pembatalan tagihan tidak bisa dilakukan karena Billing Provider belum menerima transaksi Payment',
                        ];
                    } else {
                        $data = [
                            'idPembayaran' => $data['idPembayaran'],
                            'nim' => $data['nomorPembayaran'],
                            'status_pembayaran' => 0,
                            'reversal' => 1,
                            'tgl_pembayaran' => NULL,
                            'jumlah_pembayaran' => NULL,
                            'idTransaksi' => NULL,
                            'kodeChannel' => NULL,
                            'kodebank' => NULL,
                            'ket_pembayaran' => "Tagihan dilakukan reversal",
                        ];
                        $pengajuan = ["status_id" => "1"];
                        $this->pengajuanModel->where('idPembayaran', $data["idPembayaran"])->set($pengajuan)->update();

                        if (!$this->ModelPembayaran->where(['idPembayaran' => $data['idPembayaran'], 'nim' => $data['nim']])->set($data)->update()) {
                            $response = [
                                'rc' => '91',
                                'msg' => 'Database Problem',
                            ];
                        } else {
                            $pembayaran = $this->ModelPembayaran->find($data['idPembayaran']);
                            $nama_berkas = $this->db->table('pembayaran p')
                        ->join('berkas u', 'p.berkas_id=u.id')
                        ->where('p.idPembayaran', $pembayaran['idPembayaran'])
                        ->select('
                        p.nama,
                        u.nama_berkas                         
                        ')
                        ->get()->getRowArray();
                            $response = [
                                'rc' => '00',
                                'msg' => 'Reversal berhasil',
                                'nomorPembayaran' => $pembayaran['nim'],
                                'idPelanggan' => $pembayaran['nim'],
                                'idPembayaran' => $pembayaran['idPembayaran'],
                                'nama' => $pembayaran['nama'],
                                'informasi' => [
                                    'nim' => $pembayaran['nim'],
                                    'tahunlulusan' => $pembayaran['tahunlulusan'],
                                    'namaberkas' => $nama_berkas['nama_berkas'],
                                ],
                                'rincian' => [],
                                'totalNominal' => $pembayaran['biaya'],
                            ];
                        }
                    }
                }
            } else {
                $response = [
                    'rc' => '14',
                    'msg' => 'Nomor Identitas Pembayaran tidak ditemukan',
                ];
            }
        }
        return $this->respond($response);
    }
}
