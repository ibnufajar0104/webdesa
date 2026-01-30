<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DemografiModel;

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

        return $this->response->setJSON([
            'status' => true,
            'data'   => [
                'jarak_ke_kabupaten' => $row['jarak_ke_kabupaten'] ?? '',
                'luas_wilayah'       => $row['luas_wilayah'] ?? '',
                'kepadatan'          => $row['kepadatan'] ?? '',
                'updated_at'         => $row['updated_at'] ?? null,
            ],
        ]);
    }
}
