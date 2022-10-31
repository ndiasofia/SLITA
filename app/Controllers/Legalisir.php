<?php

namespace App\Controllers;

use \Config\Database;
use App\Models\StatusModel;
use App\Models\PengajuanModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use Hermawan\DataTables\DataTable;
use App\Models\EkspedisiModel;

class Legalisir extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->statusModel = new StatusModel();
        $this->pengajuanModel = new PengajuanModel();
        $this->ekspedisiModel = new EkspedisiModel();
    }

    public function index()
    {
        if (session('level') == 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/data_legalisir');
    }

    public function modal_detail($kode_pengajuan)
    {  
        $getData  = $this->db->table('pengajuan p')
            ->join('berkas b', 'p.berkas_id=b.id')
            ->join('status s', 'p.status_id=s.id')
            ->join('pengguna u', 'p.pengguna_id=u.id')
            ->join('alumni a', 'a.nim=u.nim')
            ->join('metode_pengambilan m', 'p.metode_pengambilan_id=m.id')
            ->join('ekspedisi e', 'p.ekspedisi_id=e.id', 'LEFT')
            ->select('
                        u.nama, 
                        a.jurusan, 
                        u.nim, 
                        m.nama_metode, 
                        p.alamat, 
                        p.keterangan_berkas, 
                        s.nama_status, 
                        e.nama_ekspedisi, 
                        p.no_resi,
                        p.metode_pengambilan_id
                    ')
            ->where('p.kode_pengajuan', $kode_pengajuan)->groupBy('p.kode_pengajuan')
            ->get()->getRowArray();

        $tot_biaya = $this->pengajuanModel->where('kode_pengajuan',$kode_pengajuan)->selectSum('biaya','tot_biaya')->first();
        $berkas = $this->pengajuanModel->where('kode_pengajuan',$kode_pengajuan)->join('berkas b', 'pengajuan.berkas_id = b.id')->findAll();
        $data = [
            'nama' => $getData['nama'],
            'jurusan' => $getData['jurusan'],
            'nim' => $getData['nim'],
            'nama_metode' => $getData['nama_metode'],
            'alamat' => $getData['alamat'],
            'nama_status' => $getData['nama_status'],
            'nama_ekspedisi' => $getData['nama_ekspedisi'],
            'keterangan_berkas' => $getData['keterangan_berkas'],
            'no_resi' => $getData['no_resi'],
            'metode_pengambilan_id' => $getData['metode_pengambilan_id'],
            'biaya' => $tot_biaya['tot_biaya'],
        ];


        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('data', $data)->setVar('berkas', $berkas)->render('admin/components/modal_detail');
        return $this->respond($response, 200);
    }
    public function modal_download_berkas($kode_pengajuan)
    {       

        $data  = $this->pengajuanModel->join('berkas b', 'pengajuan.berkas_id=b.id')
        ->where('pengajuan.kode_pengajuan', $kode_pengajuan)
        ->findAll(); 


        
        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('data', $data)->render('admin/components/modal_download_berkas');
            
        return $this->respond($response, 200);
        
        
    }

    public function modal_edit($kode_pengajuan)
    {
        $data = $this->db->table('pengajuan p')
            ->join('status s', 'p.status_id=s.id')
            ->join('pengguna u', 'p.pengguna_id=u.id')
            ->where('p.kode_pengajuan', $kode_pengajuan)
            ->get()->getRowArray();

        $status = $this->statusModel->findAll();
        $ekspedisi = $this->ekspedisiModel->findAll();

        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('data', $data)
            ->setVar('status', $status)
            ->setVar('ekspedisi', $ekspedisi)
            ->render('admin/components/modal_edit');
        return $this->respond($response, 200);
    }

    public function update($kode_pengajuan)
    {
        $data = [
            'status_id' => $this->request->getPost('status'),
            'note' => $this->request->getPost('note')
        ];

        if ($this->request->getPost('ekspedisi')) {
            $data['ekspedisi_id'] = $this->request->getPost('ekspedisi');
            $data['no_resi'] = $this->request->getPost('no_resi');
        }

        $this->pengajuanModel->where('kode_pengajuan', $kode_pengajuan)->set($data)->update();
        $email = $this->request->getPost('email');

        helper('mailer');
        $cstatus = $this->db->table('pengajuan p')
            ->join('status s', 'p.status_id=s.id')
            ->join('pengguna u', 'p.pengguna_id=u.id')
            ->where('p.kode_pengajuan', $kode_pengajuan)
            ->select('
                        u.nama,
                        p.kode_pengajuan,
                        s.nama_status,
                        p.note                            
                    ')
            ->get()->getRowArray();

        $view = \Config\Services::renderer();
        $message = $view->setVar('cstatus', $cstatus)
            ->render('mailer/status');

        $mailer = sendmail($email, "Pemberitahuan Status Pengajuan", $message);

        $response = [
            'message' => 'Data Pengajuan Berhasil Diubah',
        ];

        return $this->respond($response, 200);
    }

    public function datatable()
    {
        $builder = $this->db->table('pengajuan p')
            ->join('berkas b', 'p.berkas_id=b.id')
            ->join('status s', 'p.status_id=s.id')
            ->join('pengguna u', 'p.pengguna_id=u.id')
            ->join('metode_pengambilan m', 'p.metode_pengambilan_id=m.id')
            ->select('
                        u.nama,
                        p.kode_pengajuan, 
                        p.biaya,
                        s.nama_status,
                        p.status_id,
                        p.keterangan_berkas,
                        p.nama_file,
                        p.nama_bukti_pembayaran,   
                        p.created_at,                                
                                    ')
            ->orderBy('p.created_at', 'DESC')->groupBy('p.kode_pengajuan');

        return DataTable::of($builder)->toJson(TRUE);
    }
}
