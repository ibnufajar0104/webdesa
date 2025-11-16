<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendudukModel;

class Penduduk extends BaseController
{
    protected $pendudukModel;
    protected $validation;
    protected $db;

    public function __construct()
    {
        $this->pendudukModel = new PendudukModel();
        $this->validation    = \Config\Services::validation();
        $this->db            = \Config\Database::connect();
        helper(['text', 'date']);
    }

    public function index()
    {
        return view('admin/penduduk/index', [
            'pageTitle'   => 'Data Penduduk',
            'activeMenu'  => 'penduduk',
            'dusunList'   => $this->getDusunOptions(),
            'pendidikan'  => $this->getPendidikanOptions(),
            'pekerjaan'   => $this->getPekerjaanOptions(),
            'agamaList'   => $this->getAgamaOptions(),
        ]);
    }

    public function detail($id)
    {
        $builder = $this->pendudukModel->builder();

        $builder->select(
            'penduduk.*, ' .
                'rt.no_rt, rw.no_rw, dusun.nama_dusun, ' .
                'master_pendidikan.nama_pendidikan, ' .
                'master_pekerjaan.nama_pekerjaan, ' .
                'master_agama.nama_agama'
        );
        $builder->join('rt', 'rt.id = penduduk.rt_id', 'left');
        $builder->join('rw', 'rw.id = rt.rw_id', 'left');
        $builder->join('dusun', 'dusun.id = rw.dusun_id', 'left');
        $builder->join('master_pendidikan', 'master_pendidikan.id = penduduk.pendidikan_id', 'left');
        $builder->join('master_pekerjaan', 'master_pekerjaan.id = penduduk.pekerjaan_id', 'left');
        $builder->join('master_agama', 'master_agama.id = penduduk.agama_id', 'left');

        // hanya penduduk yang belum di-soft-delete
        $builder->where('penduduk.id', $id);
        $builder->where('penduduk.deleted_at', null);

        $row = $builder->get()->getRowArray();

        if (!$row) {
            return redirect()->to('admin/data-penduduk')
                ->with('error', 'Data penduduk tidak ditemukan');
        }

        // simple hitung usia
        $usia = null;
        if (!empty($row['tanggal_lahir'])) {
            try {
                $birth = new \DateTime($row['tanggal_lahir']);
                $now   = new \DateTime();
                $usia  = $birth->diff($now)->y;
            } catch (\Exception $e) {
                $usia = null;
            }
        }

        return view('admin/penduduk/detail', [
            'pageTitle'  => 'Detail Penduduk',
            'activeMenu' => 'penduduk',
            'penduduk'   => $row,
            'usia'       => $usia,
        ]);
    }

    /**
     * DataTables server-side
     */
    public function datatable()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $request = $this->request;

        // ====== PARAM DATATABLE ======
        $draw   = (int) $request->getPost('draw');
        $start  = (int) $request->getPost('start');
        $length = (int) $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        // Order
        $order = $request->getPost('order') ?? [];
        if (!empty($order[0]['column'])) {
            $orderColumnIdx = (int) $order[0]['column'];
            $orderDir       = ($order[0]['dir'] === 'desc') ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 1; // default NIK
            $orderDir       = 'asc';
        }

        // mapping index kolom DataTables -> field database
        $columns = [
            0 => 'id',             // index #
            1 => 'nik',            // NIK
            2 => 'no_kk',          // No KK
            3 => 'nama_lengkap',   // Nama
            4 => 'jenis_kelamin',  // JK
            5 => 'tanggal_lahir',  // Usia (dari tgl lahir)
            6 => 'status_penduduk',
            7 => 'status_dasar',
            8 => 'updated_at',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'nik';

        // ====== CUSTOM FILTERS ======
        $filterDusun          = $request->getPost('filter_dusun');
        $filterJk             = $request->getPost('filter_jk');
        $filterPendidikan     = $request->getPost('filter_pendidikan');
        $filterPekerjaan      = $request->getPost('filter_pekerjaan');
        $filterStatusPenduduk = $request->getPost('filter_status_penduduk');
        $filterUsiaMin        = $request->getPost('filter_usia_min');
        $filterUsiaMax        = $request->getPost('filter_usia_max');
        $filterAgama          = $request->getPost('filter_agama');

        // ====== BASE BUILDER ======
        $builder = $this->db->table('penduduk');
        $builder->select(
            'penduduk.*, ' .
                'rt.no_rt, rw.no_rw, dusun.nama_dusun, ' .
                'master_pekerjaan.nama_pekerjaan, ' .
                'master_agama.nama_agama'
        );
        $builder->join('rt', 'rt.id = penduduk.rt_id', 'left');
        $builder->join('rw', 'rw.id = rt.rw_id', 'left');
        $builder->join('dusun', 'dusun.id = rw.dusun_id', 'left');
        $builder->join('master_pekerjaan', 'master_pekerjaan.id = penduduk.pekerjaan_id', 'left');
        $builder->join('master_agama', 'master_agama.id = penduduk.agama_id', 'left');

        // TOTAL TANPA FILTER & SEARCH (hanya yang belum di-soft-delete)
        $recordsTotal = $this->pendudukModel
            ->where('deleted_at', null)
            ->countAllResults();

        // ====== FILTER DASAR (WAJIB) ======
        $builder->where('penduduk.deleted_at', null);

        // ====== FILTER TAMBAHAN ======
        if (!empty($filterDusun)) {
            $builder->where('dusun.id', $filterDusun);
        }

        if (!empty($filterJk)) {
            $builder->where('penduduk.jenis_kelamin', $filterJk);
        }

        if (!empty($filterPendidikan)) {
            $builder->where('penduduk.pendidikan_id', $filterPendidikan);
        }

        if (!empty($filterPekerjaan)) {
            $builder->where('penduduk.pekerjaan_id', $filterPekerjaan);
        }

        if (!empty($filterStatusPenduduk)) {
            $builder->where('penduduk.status_penduduk', $filterStatusPenduduk);
        }

        // Filter Agama (pakai FK agama_id)
        if (!empty($filterAgama)) {
            $builder->where('penduduk.agama_id', $filterAgama);
        }

        // FILTER USIA (pakai TIMESTAMPDIFF YEAR)
        if ($filterUsiaMin !== null && $filterUsiaMin !== '') {
            $builder->where(
                'TIMESTAMPDIFF(YEAR, penduduk.tanggal_lahir, CURDATE()) >=',
                (int) $filterUsiaMin
            );
        }

        if ($filterUsiaMax !== null && $filterUsiaMax !== '') {
            $builder->where(
                'TIMESTAMPDIFF(YEAR, penduduk.tanggal_lahir, CURDATE()) <=',
                (int) $filterUsiaMax
            );
        }

        // ====== SEARCH GLOBAL ======
        if ($search !== '') {
            $builder->groupStart()
                ->like('penduduk.nik', $search)
                ->orLike('penduduk.no_kk', $search)
                ->orLike('penduduk.nama_lengkap', $search)
                ->orLike('dusun.nama_dusun', $search)
                ->orLike('master_agama.nama_agama', $search)
                ->groupEnd();
        }

        // HITUNG SETELAH FILTER
        $recordsFiltered = $builder->countAllResults(false);

        // ORDER + LIMIT
        $builder->orderBy('penduduk.' . $orderColumn, $orderDir)
            ->limit($length, $start);

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }

    /**
     * Ambil master pendidikan (belum di-soft-delete + aktif)
     */
    private function getPendidikanOptions(): array
    {
        return $this->db->table('master_pendidikan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Ambil master pekerjaan (belum di-soft-delete + aktif)
     */
    private function getPekerjaanOptions(): array
    {
        return $this->db->table('master_pekerjaan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Ambil master agama (belum di-soft-delete + aktif)
     */
    private function getAgamaOptions(): array
    {
        return $this->db->table('master_agama')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Ambil master RT (join RW & Dusun) untuk dropdown
     * hanya yang belum soft delete dan aktif
     */
    private function getRtOptions(): array
    {
        return $this->db->table('rt')
            ->select('rt.id, rt.no_rt, rw.no_rw, dusun.nama_dusun')
            ->join('rw', 'rw.id = rt.rw_id')
            ->join('dusun', 'dusun.id = rw.dusun_id')
            ->where('rt.deleted_at', null)
            ->where('rw.deleted_at', null)
            ->where('dusun.deleted_at', null)
            ->where('rt.is_active', 1)
            ->orderBy('dusun.nama_dusun', 'ASC')
            ->orderBy('rw.no_rw', 'ASC')
            ->orderBy('rt.no_rt', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Ambil master Dusun (belum di-soft-delete + aktif)
     */
    private function getDusunOptions(): array
    {
        return $this->db->table('dusun')
            ->where('deleted_at', null)
            ->where('is_active', 1) // kalau tidak pakai is_active, baris ini bisa dihapus
            ->orderBy('nama_dusun', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function create()
    {
        $penduduk = [
            'id'                => '',
            'nik'               => old('nik'),
            'no_kk'             => old('no_kk'),
            'nama_lengkap'      => old('nama_lengkap'),
            'jenis_kelamin'     => old('jenis_kelamin') ?? 'L',
            'tempat_lahir'      => old('tempat_lahir'),
            'tanggal_lahir'     => old('tanggal_lahir'),
            'golongan_darah'    => old('golongan_darah'),
            'agama_id'          => old('agama_id'),
            'status_perkawinan' => old('status_perkawinan') ?? 'Belum Kawin',
            'pendidikan_id'     => old('pendidikan_id'),
            'pekerjaan_id'      => old('pekerjaan_id'),
            'kewarganegaraan'   => old('kewarganegaraan') ?? 'WNI',
            'status_penduduk'   => old('status_penduduk') ?? 'Tetap',
            'status_dasar'      => old('status_dasar') ?? 'Hidup',
            'rt_id'             => old('rt_id'),
            'alamat'            => old('alamat'),
            'desa'              => old('desa') ?? 'Batilai',
            'kecamatan'         => old('kecamatan') ?? 'Pelaihari',
            'no_hp'             => old('no_hp'),
            'email'             => old('email'),
            'ktp_file'          => null,
        ];

        return view('admin/penduduk/form', [
            'pageTitle'   => 'Tambah Penduduk',
            'activeMenu'  => 'penduduk',
            'mode'        => 'create',
            'penduduk'    => $penduduk,
            'pendidikan'  => $this->getPendidikanOptions(),
            'pekerjaan'   => $this->getPekerjaanOptions(),
            'agamaList'   => $this->getAgamaOptions(),
            'rtOptions'   => $this->getRtOptions(),
            'errors'      => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        // kalau PendudukModel pakai softDeletes, find() otomatis hanya ambil yang belum deleted
        $row = $this->pendudukModel->find($id);

        if (!$row) {
            return redirect()->to('admin/penduduk')
                ->with('error', 'Data tidak ditemukan');
        }

        $penduduk = [
            'id'                => $row['id'],
            'nik'               => old('nik', $row['nik']),
            'no_kk'             => old('no_kk', $row['no_kk']),
            'nama_lengkap'      => old('nama_lengkap', $row['nama_lengkap']),
            'jenis_kelamin'     => old('jenis_kelamin', $row['jenis_kelamin']),
            'tempat_lahir'      => old('tempat_lahir', $row['tempat_lahir']),
            'tanggal_lahir'     => old('tanggal_lahir', $row['tanggal_lahir']),
            'golongan_darah'    => old('golongan_darah', $row['golongan_darah']),
            'agama_id'          => old('agama_id', $row['agama_id']),
            'status_perkawinan' => old('status_perkawinan', $row['status_perkawinan']),
            'pendidikan_id'     => old('pendidikan_id', $row['pendidikan_id']),
            'pekerjaan_id'      => old('pekerjaan_id', $row['pekerjaan_id']),
            'kewarganegaraan'   => old('kewarganegaraan', $row['kewarganegaraan']),
            'status_penduduk'   => old('status_penduduk', $row['status_penduduk']),
            'status_dasar'      => old('status_dasar', $row['status_dasar']),
            'rt_id'             => old('rt_id', $row['rt_id']),
            'alamat'            => old('alamat', $row['alamat']),
            'desa'              => old('desa', $row['desa']),
            'kecamatan'         => old('kecamatan', $row['kecamatan']),
            'no_hp'             => old('no_hp', $row['no_hp']),
            'email'             => old('email', $row['email']),
            'ktp_file'          => $row['ktp_file'],
        ];

        return view('admin/penduduk/form', [
            'pageTitle'   => 'Edit Penduduk',
            'activeMenu'  => 'penduduk',
            'mode'        => 'edit',
            'penduduk'    => $penduduk,
            'pendidikan'  => $this->getPendidikanOptions(),
            'pekerjaan'   => $this->getPekerjaanOptions(),
            'agamaList'   => $this->getAgamaOptions(),
            'rtOptions'   => $this->getRtOptions(),
            'errors'      => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'nik'           => 'required|exact_length[16]|numeric|is_unique[penduduk.nik,id,' . ($id ?: '0') . ']',
            'nama_lengkap'  => 'required|min_length[3]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'tanggal_lahir' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $data = [
            'nik'               => $this->request->getPost('nik'),
            'no_kk'             => $this->request->getPost('no_kk'),
            'nama_lengkap'      => $this->request->getPost('nama_lengkap'),
            'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'     => $this->request->getPost('tanggal_lahir'),
            'golongan_darah'    => $this->request->getPost('golongan_darah') ?: null,
            'agama_id'          => $this->request->getPost('agama_id') ?: null,
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pendidikan_id'     => $this->request->getPost('pendidikan_id') ?: null,
            'pekerjaan_id'      => $this->request->getPost('pekerjaan_id') ?: null,
            'kewarganegaraan'   => $this->request->getPost('kewarganegaraan') ?: 'WNI',
            'status_penduduk'   => $this->request->getPost('status_penduduk'),
            'status_dasar'      => $this->request->getPost('status_dasar'),
            'rt_id'             => $this->request->getPost('rt_id') ?: null,
            'alamat'            => $this->request->getPost('alamat'),
            'desa'              => $this->request->getPost('desa'),
            'kecamatan'         => $this->request->getPost('kecamatan'),
            'no_hp'             => $this->request->getPost('no_hp'),
            'email'             => $this->request->getPost('email'),
        ];

        // Handle upload KTP (opsional)
        $file = $this->request->getFile('ktp_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mime    = $file->getMimeType();
            $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'application/pdf'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['File KTP harus berupa JPG, PNG, WEBP, atau PDF']);
            }

            $uploadPath = WRITEPATH . 'uploads/ktp/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $data['ktp_file'] = 'ktp/' . $newName;
        } else {
            $data['ktp_file'] = $this->request->getPost('ktp_file_old') ?: null;
        }

        if ($id) {
            $this->pendudukModel->update($id, $data);
            $msg = 'Data penduduk berhasil diperbarui';
        } else {
            $this->pendudukModel->insert($data);
            $msg = 'Data penduduk berhasil ditambahkan';
        }

        return redirect()->to('admin/data-penduduk')
            ->with('success', $msg);
    }

    public function delete()
    {
        if (!$this->request->isAJAX()) {
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

        // kalau model pakai softDeletes=true, ini otomatis set deleted_at
        $row = $this->pendudukModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->pendudukModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Data penduduk berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }
}
