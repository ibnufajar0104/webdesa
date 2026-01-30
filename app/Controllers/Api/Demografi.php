<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DemografiModel;
use App\Models\DusunModel;
use App\Models\MasterRtModel;
use App\Models\PendudukModel;

class Demografi extends BaseController
{
    protected DemografiModel $model;

    public function __construct()
    {
        $this->model = new DemografiModel();
    }

    /**
     * GET /api/demografi
     * Ambil data demografi desa.
     */
    public function index()
    {
        // Ambil data pertama saja (single row concept)
        $row = $this->model->first();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Data demografi belum diatur',
            ]);
        }

        // Hitung statistik
        $dusunModel    = new DusunModel();
        $rtModel       = new MasterRtModel();
        $pendudukModel = new PendudukModel();

        $jumlahDusun    = $dusunModel->countAllResults();
        $jumlahRt       = $rtModel->countAllResults();
        $jumlahPenduduk = $pendudukModel->countAllResults();
        
        // Hitung KK dari kolom no_kk yg distinct di tabel penduduk (abaikan null/empty)
        $jumlahKk = $pendudukModel->distinct()
                                  ->select('no_kk')
                                  ->where('no_kk !=', '')
                                  ->where('no_kk IS NOT NULL')
                                  ->countAllResults();

        return $this->response->setJSON([
            'status' => true,
            'data'   => [
                'jarak_ke_kabupaten' => $row['jarak_ke_kabupaten'] ?? '',
                'luas_wilayah'       => $row['luas_wilayah'] ?? '',
                'kepadatan'          => $row['kepadatan'] ?? '',
                'jumlah_dusun'       => $jumlahDusun,
                'jumlah_rt'          => $jumlahRt,
                'jumlah_penduduk'    => $jumlahPenduduk,
                'jumlah_kk'          => $jumlahKk,
                'updated_at'         => $row['updated_at'] ?? null,
            ],
        ]);
    }
}
