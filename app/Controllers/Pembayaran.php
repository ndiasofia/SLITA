<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPembayaran;
use \Config\Database;
use \Hermawan\DataTables\DataTable;

class Pembayaran extends BaseController
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
        if (session('level') == 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $total = 0;
        $jumlah = 0;
        $tagihan = $this->ModelPembayaran->where('status_pembayaran', 1)->findColumn('jumlah_pembayaran');
        if ($tagihan) {
            for ($i = 0; $i < count($tagihan); $i++) {
                $total += $tagihan[$i];
            }
        }
        $pembayaran = $this->ModelPembayaran->where('status_pembayaran', 0)->findColumn('biaya');
        if ($pembayaran) {
            for ($i = 0; $i < count($pembayaran); $i++) {
                $jumlah += $pembayaran[$i];
            }
        }

        $bank = $this->db->table('pembayaran')
            ->select('
                            kodebank,
                            SUM(jumlah_pembayaran) as total
                            ')
            ->where('status_pembayaran', 1)
            ->groupBy('kodebank')
            ->get()->getResultArray();

        $data = [
            'belumBayar' => count($this->ModelPembayaran->where('status_pembayaran', 0)->findAll()),
            'sudahBayar' => count($this->ModelPembayaran->where('status_pembayaran', 1)->findAll()),
            'nomor' => $this->request->getVar('page') == 1 ? '0' : $this->request->getVar('page'),
            'total' => $total,
            'jumlah' => $jumlah,
            'estimasi' => $jumlah + $total,
            'bank' => $bank
        ];
        return view('admin/data_pembayaran', $data);
    }

    public function excel()
    {
        $data = [
            'nomor' => $this->request->getVar('page') == 1 ? '0' : $this->request->getVar('page'),
            'rekapPembayaran' => $this->ModelPembayaran->findAll()
        ];

        return view('pembayaran/excel', $data);
    }

    public function datatable()
    {
        $builder = $this->db->table('pembayaran')->orderBy('idPembayaran', 'DESC');

        return DataTable::of($builder)->toJson(TRUE);
    }
}
