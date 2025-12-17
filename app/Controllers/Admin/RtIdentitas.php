<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RtIdentitasModel;

class RtIdentitas extends BaseController
{
    protected RtIdentitasModel $identitasModel;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->identitasModel = new RtIdentitasModel();
        $this->db             = \Config\Database::connect();
        $this->validation     = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/rt_identitas/index', [
            'pageTitle'  => 'Identitas RT',
            'activeMenu' => 'rt_identitas',
            'rtList'     => $this->getRtOptions(),
        ]);
    }

    public function datatable()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $request = $this->request;

        $draw   = (int) $request->getPost('draw');
        $start  = (int) $request->getPost('start');
        $length = (int) $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        $order = $request->getPost('order') ?? [];
        if (!empty($order[0]['column'])) {
            $orderColumnIdx = (int) $order[0]['column'];
            $orderDir       = ($order[0]['dir'] === 'desc') ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 1; // default RT
            $orderDir       = 'asc';
        }

        $columns = [
            0 => 'ri.id',
            1 => 'r.no_rt',
            2 => 'ri.nama_ketua',
            3 => 'ri.no_hp_ketua',
            4 => 'ri.is_active',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'r.no_rt';

        $filterRt     = $request->getPost('filter_rt');
        $filterStatus = $request->getPost('filter_status');

        $builder = $this->db->table('rt_identitas ri');
        $builder->select('
            ri.*,
            r.no_rt,
            r.id_dusun
        ');
        $builder->join('rt r', 'r.id = ri.rt_id', 'left');

        // total (soft delete only)
        $recordsTotal = $this->identitasModel
            ->where('deleted_at', null)
            ->countAllResults();

        $builder->where('ri.deleted_at', null);

        if (!empty($filterRt)) {
            $builder->where('ri.rt_id', (int) $filterRt);
        }

        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('ri.is_active', (int) $filterStatus);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('r.no_rt', $search)
                ->orLike('ri.nama_ketua', $search)
                ->orLike('ri.no_hp_ketua', $search)
                ->orLike('ri.email_ketua', $search)
                ->orLike('ri.sk_nomor', $search)
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
            'id'                => '',
            'rt_id'             => old('rt_id'),
            'nama_ketua'        => old('nama_ketua'),
            'nik_ketua'         => old('nik_ketua'),
            'no_hp_ketua'       => old('no_hp_ketua'),
            'email_ketua'       => old('email_ketua'),
            'alamat_sekretariat' => old('alamat_sekretariat'),
            'sk_nomor'          => old('sk_nomor'),
            'sk_tanggal'        => old('sk_tanggal'),
            'tmt_mulai'         => old('tmt_mulai'),
            'tmt_selesai'       => old('tmt_selesai'),
            'keterangan'        => old('keterangan'),
            'is_active'         => old('is_active') ?? 1,
        ];

        return view('admin/rt_identitas/form', [
            'pageTitle'  => 'Tambah Identitas RT',
            'activeMenu' => 'rt_identitas',
            'mode'       => 'create',
            'row'        => $row,
            'rtList'     => $this->getRtOptions(),
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $row = $this->identitasModel->find($id);

        if (!$row) {
            return redirect()->to('admin/rt-identitas')
                ->with('error', 'Data identitas RT tidak ditemukan');
        }

        // merge old input
        foreach ($row as $k => $v) {
            $row[$k] = old($k, $v);
        }

        return view('admin/rt_identitas/form', [
            'pageTitle'  => 'Edit Identitas RT',
            'activeMenu' => 'rt_identitas',
            'mode'       => 'edit',
            'row'        => $row,
            'rtList'     => $this->getRtOptions(),
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'rt_id' => [
                'label' => 'RT',
                'rules' => 'required|is_not_unique[rt.id,id]'
                    . '|is_unique[rt_identitas.rt_id,id,' . ($id ?: 'NULL') . ']',
                'errors' => [
                    'is_unique' => 'Identitas untuk RT ini sudah ada.',
                ],
            ],
            'nama_ketua'  => 'required|min_length[3]|max_length[150]',
            'no_hp_ketua' => 'permit_empty|max_length[30]',
            'email_ketua' => 'permit_empty|valid_email|max_length[150]',
            'is_active'   => 'required|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $data = [
            'rt_id'              => (int) $this->request->getPost('rt_id'),
            'nama_ketua'         => $this->request->getPost('nama_ketua'),
            'nik_ketua'          => $this->request->getPost('nik_ketua'),
            'no_hp_ketua'        => $this->request->getPost('no_hp_ketua'),
            'email_ketua'        => $this->request->getPost('email_ketua'),
            'alamat_sekretariat' => $this->request->getPost('alamat_sekretariat'),
            'sk_nomor'           => $this->request->getPost('sk_nomor'),
            'sk_tanggal'         => $this->request->getPost('sk_tanggal') ?: null,
            'tmt_mulai'          => $this->request->getPost('tmt_mulai') ?: null,
            'tmt_selesai'        => $this->request->getPost('tmt_selesai') ?: null,
            'keterangan'         => $this->request->getPost('keterangan'),
            'is_active'          => (int) $this->request->getPost('is_active'),
        ];

        if ($id) {
            $this->identitasModel->update($id, $data);
            return redirect()->to('admin/rt-identitas')->with('success', 'Identitas RT berhasil diperbarui');
        }

        $this->identitasModel->insert($data);
        return redirect()->to('admin/rt-identitas')->with('success', 'Identitas RT berhasil ditambahkan');
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

        $row = $this->identitasModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data identitas RT tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->identitasModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Identitas RT berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }

    private function getRtOptions(): array
    {
        // ambil master rt aktif (kalau tabel rt kamu pakai soft delete, tambahkan where deleted_at null)
        return $this->db->table('rt')
            ->select('id, no_rt')
            ->where('is_active', 1)
            ->orderBy('no_rt', 'ASC')
            ->get()
            ->getResultArray();
    }
}
