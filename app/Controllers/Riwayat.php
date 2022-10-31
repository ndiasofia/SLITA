<?php

namespace App\Controllers;

use \Config\Database;
use App\Models\PengajuanModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use Hermawan\DataTables\DataTable;

class Riwayat extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->pengajuanModel = new PengajuanModel();
    }

    public function index()
    {
        if (session('level') != 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('riwayat/index');
    }

    public function modal_update_berkas($kode_pengajuan)
    {
        $data = $this->pengajuanModel->where('kode_pengajuan', $kode_pengajuan)->findAll();       
        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('data', $data)->setVar('kode_pengajuan', $kode_pengajuan)
            ->render('riwayat/components/modal_update_berkas');
        return $this->respond($response, 200);
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
                        s.nama_status, 
                        e.nama_ekspedisi, 
                        p.no_resi,
                        p.metode_pengambilan_id
                    ')
            ->where('p.kode_pengajuan', $kode_pengajuan)->groupBy('p.kode_pengajuan')
            ->get()->getRowArray();
        $berkas = $this->pengajuanModel->where('kode_pengajuan',$kode_pengajuan)->join('berkas b', 'pengajuan.berkas_id = b.id')->findAll();
            

        $tot_biaya = $this->pengajuanModel->where('kode_pengajuan',$kode_pengajuan)->selectSum('biaya','tot_biaya')->first();
    
        $data = [
            'nama' => $getData['nama'],
            'jurusan' => $getData['jurusan'],
            'nim' => $getData['nim'],
            'nama_metode' => $getData['nama_metode'],
            'alamat' => $getData['alamat'],
            'nama_status' => $getData['nama_status'],
            'nama_ekspedisi' => $getData['nama_ekspedisi'],
            'no_resi' => $getData['no_resi'],
            'metode_pengambilan_id' => $getData['metode_pengambilan_id'],
            'biaya' => $tot_biaya['tot_biaya'],
        ];
        $view = \Config\Services::renderer();
        $response['html'] = $view->setVar('data', $data)->setVar('berkas', $berkas)->render('riwayat/components/modal_detail');
        return $this->respond($response, 200);
    }

    public function datatable()
    {
        $builder = $this->db->table('pengajuan p')
            ->join('berkas b', 'p.berkas_id=b.id')
            ->join('status s', 'p.status_id=s.id')
            ->join('metode_pengambilan m', 'p.metode_pengambilan_id=m.id')
            ->select('
                        p.kode_pengajuan, 
                        p.status_id,
                        p.bukti_id,
                        s.nama_status,
                        b.nama_berkas,
                        p.nama_bukti_pembayaran,
                        p.keterangan_berkas,
                        p.created_at,   
                        SUM(p.biaya) as tot_biaya,
                        COUNT(berkas_id) as tot_berkas
                    ')
            ->where('p.pengguna_id', session('pengguna_id'))->groupBy('p.kode_pengajuan')
            ->orderBy('p.kode_pengajuan', 'DESC');
        
        return DataTable::of($builder)->toJson(TRUE);
    }    
}
