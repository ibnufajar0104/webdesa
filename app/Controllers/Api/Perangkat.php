<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Perangkat extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * GET /api/perangkat?active=1
     * Public-safe: nama, foto_url, jabatan
     */
    public function index()
    {
        $active = $this->request->getGet('active');
        $active = ($active === null || $active === '') ? 1 : (int)$active;

        $builder = $this->db->table('perangkat_desa p')
            ->select("
                p.id,
                p.nama,
                p.foto_file,
                mj.nama_jabatan as jabatan,
                mj.urut as jabatan_urut
            ", false)
            ->join('master_jabatan mj', 'mj.id = p.jabatan_id', 'left')
            ->where('p.deleted_at', null);

        if ($active === 0 || $active === 1) {
            $builder->where('p.status_aktif', $active);
        }

        // order by urut master jabatan, lalu nama
        $rows = $builder
            ->orderBy('mj.urut', 'ASC')
            ->orderBy('mj.nama_jabatan', 'ASC')
            ->orderBy('p.nama', 'ASC')
            ->get()
            ->getResultArray();

        $rows = array_map(function ($r) {
            $r['foto_url'] = $this->fotoUrl($r['foto_file'] ?? null);
            unset($r['foto_file'], $r['jabatan_urut']); // jangan expose path internal & kolom bantu
            return $r;
        }, $rows);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    /**
     * GET /api/perangkat/{id}
     * Public-safe detail: nama, foto_url, jabatan
     */
    public function show($id = null)
    {
        $id = (int)($id ?? 0);
        if ($id <= 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => false,
                'message' => 'Invalid id',
            ]);
        }

        $row = $this->db->table('perangkat_desa p')
            ->select("
                p.id,
                p.nama,
                p.foto_file,
                mj.nama_jabatan as jabatan
            ", false)
            ->join('master_jabatan mj', 'mj.id = p.jabatan_id', 'left')
            ->where('p.deleted_at', null)
            ->where('p.id', $id)
            ->get()
            ->getRowArray();

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Perangkat not found',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => [
                'id'       => (int)$row['id'],
                'nama'     => $row['nama'],
                'jabatan'  => $row['jabatan'] ?? null,
                'foto_url' => $this->fotoUrl($row['foto_file'] ?? null),
            ],
        ]);
    }

    private function fotoUrl(?string $fotoFile): ?string
    {
        if (!$fotoFile) return null;

        // p.foto_file biasanya: "perangkat/namafile.ext"
        $fileName = basename($fotoFile);
        return base_url('file/perangkat/' . $fileName);
    }
}
