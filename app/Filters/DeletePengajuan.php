<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use CodeIgniter\API\ResponseTrait;
use \Config\Database;
use App\Models\PengajuanModel;
use App\Models\ModelPembayaran;
use DateInterval;

class DeletePengajuan implements FilterInterface
{
    use ResponseTrait;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->pengajuanModel = new PengajuanModel();
        $this->pembayaranModel = new ModelPembayaran();
    }


    // function untuk melihat apakah pengajuan yang akan dihapus sudah di bayar atau belum selama 2 hari
    public function before(RequestInterface $request, $arguments = null)
    {
        $pengajuan = $this->pengajuanModel->where('status_id', 1)->findColumn('created_at');
        if ($pengajuan) {
            $tenggat = new DateTime();
            $batas = new DateTime();
            for ($x = 0; $x < count($pengajuan); $x++) {
                $tenggat->setTimestamp(strtotime($pengajuan[$x]));
                $tenggat->add(new DateInterval('P2D'));
                if ($tenggat->format('Y-m-d') <= $batas->format('Y-m-d')) {
                    $idPembayaran = $this->pengajuanModel->where('status_id', 1)->findColumn('idPembayaran');
                    $this->pembayaranModel->where('idPembayaran', $idPembayaran[$x])->delete();
                    // $this->pengajuanModel->where('idPembayaran', $idPembayaran)->delete();
                    $pengajuan = ["status_id" => "6"];
                    $this->pengajuanModel->where('idPembayaran', $idPembayaran[$x])->set($pengajuan)->update();
                    $pengajuan = ['idPembayaran' => NULL];
                    $this->pengajuanModel->where('idPembayaran', $idPembayaran[$x])->set($pengajuan)->update();
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
