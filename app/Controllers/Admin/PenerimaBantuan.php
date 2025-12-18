<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenerimaBantuanModel;

class PenerimaBantuan extends BaseController
{
    protected PenerimaBantuanModel $model;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->model      = new PenerimaBantuanModel();
        $this->db         = \Config\Database::connect();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/penerima_bantuan/index', [
            'pageTitle'    => 'Penerima Bantuan',
            'activeMenu'   => 'penerima_bantuan',
            'bantuanList'  => $this->getBantuanOptions(),
            'tahunDefault' => (int) date('Y'),
        ]);
    }

    public function datatable()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $req    = $this->request;
        $draw   = (int) $req->getPost('draw');
        $start  = (int) $req->getPost('start');
        $length = (int) $req->getPost('length');
        $search = $req->getPost('search')['value'] ?? '';

        $order = $req->getPost('order') ?? [];
        if (!empty($order[0]['column'])) {
            $orderColumnIdx = (int) $order[0]['column'];
            $orderDir       = ($order[0]['dir'] === 'desc') ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 2; // default nama penduduk
            $orderDir       = 'asc';
        }

        // kolom datatable (sesuaikan dengan columns di view)
        $columns = [
            0 => 'penerima_bantuan.id',
            1 => 'master_bantuan.nama_bantuan',
            2 => 'penduduk.nama_lengkap',        // <--- GANTI kalau kolom nama penduduk beda
            3 => 'penduduk.nik',         // <--- GANTI kalau kolom nik penduduk beda
            4 => 'penerima_bantuan.tahun',
            5 => 'penerima_bantuan.periode',
            6 => 'penerima_bantuan.nominal',
            7 => 'penerima_bantuan.status',
            8 => 'penerima_bantuan.tanggal_terima',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'penduduk.nama';

        $filterBantuan = $req->getPost('filter_bantuan');
        $filterTahun   = $req->getPost('filter_tahun');
        $filterStatus  = $req->getPost('filter_status');

        $builder = $this->db->table('penerima_bantuan');
        $builder->select(
            'penerima_bantuan.*, ' .
                'master_bantuan.nama_bantuan, ' .
                'penduduk.nama_lengkap AS nama_penduduk, ' .
                'penduduk.nik AS nik_penduduk'
        );
        $builder->join('master_bantuan', 'master_bantuan.id = penerima_bantuan.bantuan_id', 'left');
        $builder->join('penduduk', 'penduduk.id = penerima_bantuan.penduduk_id', 'left');

        $builder->where('penerima_bantuan.deleted_at', null);

        $recordsTotal = $this->model
            ->where('deleted_at', null)
            ->countAllResults();

        if (!empty($filterBantuan)) {
            $builder->where('penerima_bantuan.bantuan_id', (int)$filterBantuan);
        }
        if (!empty($filterTahun)) {
            $builder->where('penerima_bantuan.tahun', (int)$filterTahun);
        }
        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('penerima_bantuan.status', (int)$filterStatus);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('penduduk.nama', $search)
                ->orLike('penduduk.nik', $search)
                ->orLike('master_bantuan.nama_bantuan', $search)
                ->orLike('penerima_bantuan.periode', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        $builder->orderBy($orderColumn, $orderDir)
            ->limit($length, $start);

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
            'newToken'        => csrf_hash(),
        ]);
    }

    public function create()
    {
        $row = [
            'id'            => '',
            'penduduk_id'   => old('penduduk_id'),
            'bantuan_id'    => old('bantuan_id'),
            'tahun'         => old('tahun') ?? (int) date('Y'),
            'periode'       => old('periode'),
            'tanggal_terima' => old('tanggal_terima'),
            'nominal'       => old('nominal'),
            'status'        => old('status') ?? 1,
            'keterangan'    => old('keterangan'),
        ];

        return view('admin/penerima_bantuan/form', [
            'pageTitle'   => 'Tambah Penerima Bantuan',
            'activeMenu'  => 'penerima_bantuan',
            'mode'        => 'create',
            'row'         => $row,
            'errors'      => session('errors') ?? [],
            'bantuanList' => $this->getBantuanOptions(),
            'pendudukSelected' => $this->getPendudukSelected($row['penduduk_id']),
        ]);
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (!$row) {
            return redirect()->to('admin/penerima-bantuan')->with('error', 'Data tidak ditemukan');
        }

        foreach ($row as $k => $v) {
            $row[$k] = old($k, $v);
        }

        return view('admin/penerima_bantuan/form', [
            'pageTitle'   => 'Edit Penerima Bantuan',
            'activeMenu'  => 'penerima_bantuan',
            'mode'        => 'edit',
            'row'         => $row,
            'errors'      => session('errors') ?? [],
            'bantuanList' => $this->getBantuanOptions(),
            'pendudukSelected' => $this->getPendudukSelected($row['penduduk_id']),
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'penduduk_id'    => 'required|is_natural_no_zero',
            'bantuan_id'     => 'required|is_natural_no_zero',
            'tahun'          => 'required|integer|greater_than_equal_to[2000]|less_than_equal_to[2100]',
            'periode'        => 'permit_empty|max_length[30]',
            'tanggal_terima' => 'permit_empty|valid_date',
            'nominal'        => 'permit_empty|decimal',
            'status'         => 'required|in_list[0,1]',
            'keterangan'     => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $data = [
            'penduduk_id'    => (int) $this->request->getPost('penduduk_id'),
            'bantuan_id'     => (int) $this->request->getPost('bantuan_id'),
            'tahun'          => (int) $this->request->getPost('tahun'),
            'periode'        => $this->request->getPost('periode') ?: null,
            'tanggal_terima' => $this->request->getPost('tanggal_terima') ?: null,
            'nominal'        => $this->request->getPost('nominal') !== '' ? $this->request->getPost('nominal') : null,
            'status'         => (int) $this->request->getPost('status'),
            'keterangan'     => $this->request->getPost('keterangan'),
        ];

        try {
            if ($id) {
                $this->model->update($id, $data);
                return redirect()->to('admin/penerima-bantuan')->with('success', 'Data berhasil diperbarui');
            }

            $this->model->insert($data);
            return redirect()->to('admin/penerima-bantuan')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $e) {
            // kemungkinan bentrok UNIQUE (penduduk_id, bantuan_id, tahun, periode)
            return redirect()->back()
                ->withInput()
                ->with('errors', ['Data duplikat: penduduk + bantuan + tahun + periode sudah ada.']);
        }
    }

    public function delete()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $id = $this->request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'ID tidak valid',
                'newToken' => csrf_hash(),
            ]);
        }

        $row = $this->model->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->model->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Data berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }

    // =========================
    // SELECT2 Penduduk Options
    // =========================
    public function pendudukOptions()
    {
        // untuk select2 ajax
        $q = (string) $this->request->getGet('q');
        $q = trim($q);

        $builder = $this->db->table('penduduk');
        $builder->select('id, nama_lengkap, nik'); // <--- GANTI kalau kolom beda
        // jika penduduk pakai soft delete, aktifkan ini:
        // $builder->where('deleted_at', null);

        if ($q !== '') {
            $builder->groupStart()
                ->like('nama_lengkap', $q)
                ->orLike('nik', $q)
                ->groupEnd();
        }

        $rows = $builder->orderBy('nama_lengkap', 'ASC')
            ->limit(20)
            ->get()->getResultArray();

        $results = [];
        foreach ($rows as $r) {
            $label = trim(($r['nama_lengkap'] ?? '') . ' — NIK: ' . ($r['nik'] ?? '-'));
            $results[] = ['id' => $r['id'], 'text' => $label];
        }

        return $this->response->setJSON(['results' => $results]);
    }

    // =========================
    // HELPERS
    // =========================
    private function getBantuanOptions(): array
    {
        return $this->db->table('master_bantuan')
            ->select('id, nama_bantuan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();
    }

    private function getPendudukSelected($pendudukId)
    {
        if (!$pendudukId) return null;

        $row = $this->db->table('penduduk')
            ->select('id, nama_lengkap, nik') // <--- GANTI kalau kolom beda
            ->where('id', (int)$pendudukId)
            ->get()->getRowArray();

        if (!$row) return null;

        return [
            'id'   => $row['id'],
            'text' => trim(($row['nama_lengkap'] ?? '') . ' — NIK: ' . ($row['nik'] ?? '-')),
        ];
    }
}
