<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BpdJabatanHistoryModel;
use App\Models\BpdModel;
use App\Models\BpdPendidikanHistoryModel;

class Bpd extends BaseController
{
    protected $bpdModel;
    protected $histPendidikanModel;
    protected $histJabatanModel;
    protected $db;
    protected $validation;

    public function __construct()
    {
        // Pastikan Model ini mengarah ke tabel 'bpd'
        $this->bpdModel            = new BpdModel();
        // Pastikan Model ini mengarah ke tabel 'bpd_pendidikan_history'
        $this->histPendidikanModel = new BpdPendidikanHistoryModel();
        // Pastikan Model ini mengarah ke tabel 'bpd_jabatan_history'
        $this->histJabatanModel    = new BpdJabatanHistoryModel();

        $this->db                  = \Config\Database::connect();
        $this->validation          = \Config\Services::validation();
        helper(['text', 'date']);
    }

    public function index()
    {
        return view('admin/bpd/index', [
            'pageTitle'   => 'Anggota BPD',
            'activeMenu'  => 'bpd',
            'jabatanList' => $this->getJabatanOptions(),
        ]);
    }

    public function datatable()
    {
        if (!$this->request->isAJAX()) {
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
            $orderDir       = $order[0]['dir'] === 'desc' ? 'desc' : 'asc';
        } else {
            $orderColumnIdx = 1; // default nama
            $orderDir       = 'asc';
        }

        $columns = [
            0 => 'id',
            1 => 'nama',
            2 => 'nip',
            3 => 'nik',
            4 => 'jabatan_id',
            5 => 'status_aktif',
            6 => 'tmt_jabatan',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'nama';

        $filterJabatan = $request->getPost('filter_jabatan');
        $filterStatus  = $request->getPost('filter_status');

        // UBAH: Menggunakan tabel bpd
        $builder = $this->db->table('bpd');
        $builder->select(
            'bpd.*, ' .
                'master_jabatan.nama_jabatan, ' .
                'master_pendidikan.nama_pendidikan'
        );
        $builder->join('master_jabatan', 'master_jabatan.id = bpd.jabatan_id', 'left');
        $builder->join('master_pendidikan', 'master_pendidikan.id = bpd.pendidikan_id', 'left');

        // Total tanpa filter (soft delete only)
        $recordsTotal = $this->bpdModel
            ->where('deleted_at', null)
            ->countAllResults();

        $builder->where('bpd.deleted_at', null);

        if (!empty($filterJabatan)) {
            $builder->where('bpd.jabatan_id', $filterJabatan);
        }

        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('bpd.status_aktif', (int) $filterStatus);
        }

        if ($search !== '') {
            $builder->groupStart()
                ->like('bpd.nama', $search)
                ->orLike('bpd.nip', $search)
                ->orLike('bpd.nik', $search)
                ->orLike('master_jabatan.nama_jabatan', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        $builder->orderBy('bpd.' . $orderColumn, $orderDir)
            ->limit($length, $start);

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }

    public function create()
    {
        $bpd = [
            'id'            => '',
            'nama'          => old('nama'),
            'nip'           => old('nip'),
            'nik'           => old('nik'),
            'jenis_kelamin' => old('jenis_kelamin') ?? 'L',
            'jabatan_id'    => old('jabatan_id'),
            'pendidikan_id' => old('pendidikan_id'),
            'tmt_jabatan'   => old('tmt_jabatan'),
            'status_aktif'  => old('status_aktif') ?? 1,
            'no_hp'         => old('no_hp'),
            'email'         => old('email'),
            'alamat'        => old('alamat'),
            'foto_file'     => null,
        ];

        // UBAH: View path ke admin/bpd/form
        return view('admin/bpd/form', [
            'pageTitle'   => 'Tambah Anggota BPD',
            'activeMenu'  => 'bpd',
            'mode'        => 'create',
            'perangkat'   => $bpd, // Tetap gunakan variabel 'perangkat' agar tidak perlu ubah view secara drastis
            'jabatanList' => $this->getJabatanOptions(),
            'pendidikan'  => $this->getPendidikanOptions(),
            'errors'      => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $row = $this->bpdModel->find($id);

        if (!$row) {
            // UBAH: Redirect path
            return redirect()->to('admin/bpd')
                ->with('error', 'Data anggota BPD tidak ditemukan');
        }

        $bpd = [
            'id'            => $row['id'],
            'nama'          => old('nama', $row['nama']),
            'nip'           => old('nip', $row['nip']),
            'nik'           => old('nik', $row['nik']),
            'jenis_kelamin' => old('jenis_kelamin', $row['jenis_kelamin']),
            'jabatan_id'    => old('jabatan_id', $row['jabatan_id']),
            'pendidikan_id' => old('pendidikan_id', $row['pendidikan_id']),
            'tmt_jabatan'   => old('tmt_jabatan', $row['tmt_jabatan']),
            'status_aktif'  => old('status_aktif', $row['status_aktif']),
            'no_hp'         => old('no_hp', $row['no_hp']),
            'email'         => old('email', $row['email']),
            'alamat'        => old('alamat', $row['alamat']),
            'foto_file'     => $row['foto_file'],
        ];

        // UBAH: View path ke admin/bpd/form
        return view('admin/bpd/form', [
            'pageTitle'   => 'Edit Anggota BPD',
            'activeMenu'  => 'bpd',
            'mode'        => 'edit',
            'perangkat'   => $bpd, // Tetap gunakan 'perangkat' agar kompatibel dengan view form yg dicopy
            'jabatanList' => $this->getJabatanOptions(),
            'pendidikan'  => $this->getPendidikanOptions(),
            'errors'      => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'nama'          => 'required|min_length[3]',
            'jenis_kelamin' => 'required|in_list[L,P]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'nip'           => $this->request->getPost('nip'),
            'nik'           => $this->request->getPost('nik'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'jabatan_id'    => $this->request->getPost('jabatan_id') ?: null,
            'pendidikan_id' => $this->request->getPost('pendidikan_id') ?: null,
            'tmt_jabatan'   => $this->request->getPost('tmt_jabatan') ?: null,
            'status_aktif'  => (int) ($this->request->getPost('status_aktif') ?? 1),
            'no_hp'         => $this->request->getPost('no_hp'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
        ];

        // Upload foto (opsional)
        $file = $this->request->getFile('foto_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mime    = $file->getMimeType();
            $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['File foto harus berupa JPG, PNG, atau WEBP']);
            }

            // UBAH: Path upload dipisah ke uploads/bpd/
            $uploadPath = WRITEPATH . 'uploads/bpd/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            // Simpan path database sebagai bpd/namafile
            $data['foto_file'] = 'bpd/' . $newName;
        } else {
            $data['foto_file'] = $this->request->getPost('foto_file_old') ?: null;
        }

        if ($id) {
            $this->bpdModel->update($id, $data);
            $msg = 'Data anggota BPD berhasil diperbarui';
        } else {
            $this->bpdModel->insert($data);
            $id  = $this->bpdModel->getInsertID();
            $msg = 'Data anggota BPD berhasil ditambahkan';
        }

        // UBAH: Redirect ke admin/bpd/detail
        return redirect()->to('admin/bpd/detail/' . $id)
            ->with('success', $msg);
    }

    public function detail($id)
    {
        $builder = $this->bpdModel->builder();

        // UBAH: Select dari bpd
        $builder->select(
            'bpd.*, ' .
                'master_jabatan.nama_jabatan, ' .
                'master_pendidikan.nama_pendidikan'
        );
        $builder->join('master_jabatan', 'master_jabatan.id = bpd.jabatan_id', 'left');
        $builder->join('master_pendidikan', 'master_pendidikan.id = bpd.pendidikan_id', 'left');
        $builder->where('bpd.id', $id);
        $builder->where('bpd.deleted_at', null);

        $row = $builder->get()->getRowArray();

        if (!$row) {
            return redirect()->to('admin/bpd')
                ->with('error', 'Data anggota BPD tidak ditemukan');
        }

        // UBAH: Mengambil history pendidikan dari tabel BPD
        // Perhatikan join dan where menggunakan nama tabel bpd_pendidikan_history
        $pendidikanHist = $this->histPendidikanModel
            ->select(
                'bpd_pendidikan_history.*, master_pendidikan.nama_pendidikan'
            )
            ->join('master_pendidikan', 'master_pendidikan.id = bpd_pendidikan_history.pendidikan_id', 'left')
            ->where('bpd_pendidikan_history.perangkat_id', $id) // ASUMSI: Kolom FK adalah perangkat_id
            ->where('bpd_pendidikan_history.deleted_at', null)
            ->orderBy('tahun_lulus', 'DESC')
            ->findAll();

        // UBAH: Mengambil history jabatan dari tabel BPD
        $jabatanHist = $this->histJabatanModel
            ->select(
                'bpd_jabatan_history.*, master_jabatan.nama_jabatan'
            )
            ->join('master_jabatan', 'master_jabatan.id = bpd_jabatan_history.jabatan_id', 'left')
            ->where('bpd_jabatan_history.perangkat_id', $id) // ASUMSI: Kolom FK adalah perangkat_id
            ->where('bpd_jabatan_history.deleted_at', null)
            ->orderBy('tmt_mulai', 'DESC')
            ->findAll();

        // UBAH: View path
        return view('admin/bpd/detail', [
            'pageTitle'        => 'Detail Anggota BPD',
            'activeMenu'       => 'bpd',
            'perangkat'        => $row, // Variabel tetap 'perangkat' agar view detail.php tidak error
            'pendidikanHist'   => $pendidikanHist,
            'jabatanHist'      => $jabatanHist,
            'jabatanList'      => $this->getJabatanOptions(),
            'pendidikanMaster' => $this->getPendidikanOptions(),
        ]);
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

        $row = $this->bpdModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data anggota BPD tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->bpdModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Data anggota BPD berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }

    // ==========================
    // CRUD RIWAYAT PENDIDIKAN
    // ==========================

    public function savePendidikanHistory()
    {
        // NOTE: Di view, input hidden name tetap 'perangkat_id' atau ubah jadi 'bpd_id'?
        // Disini saya terima 'bpd_id' jika Anda mengubah view, atau fallback ke 'perangkat_id'
        $bpdId = $this->request->getPost('bpd_id') ?? $this->request->getPost('perangkat_id');
        $id    = $this->request->getPost('id');

        if (!$bpdId) {
            return redirect()->back()->with('error', 'Data BPD tidak valid');
        }

        $data = [
            'bpd_id'        => $bpdId, // Column database harus bpd_id
            'pendidikan_id' => $this->request->getPost('pendidikan_id') ?: null,
            'nama_lembaga'  => $this->request->getPost('nama_lembaga'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'tahun_masuk'   => $this->request->getPost('tahun_masuk') ?: null,
            'tahun_lulus'   => $this->request->getPost('tahun_lulus') ?: null,
        ];

        $file = $this->request->getFile('ijazah_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mime    = $file->getMimeType();
            $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'application/pdf'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->with('error', 'File ijazah harus berupa JPG, PNG, WEBP, atau PDF');
            }

            $uploadPath = WRITEPATH . 'uploads/ijazah/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $data['ijazah_file'] = 'ijazah/' . $newName;
        } else {
            $data['ijazah_file'] = $this->request->getPost('ijazah_file_old') ?: null;
        }

        if ($id) {
            $this->histPendidikanModel->update($id, $data);
            $msg = 'Riwayat pendidikan berhasil diperbarui';
        } else {
            $this->histPendidikanModel->insert($data);
            $msg = 'Riwayat pendidikan berhasil ditambahkan';
        }

        return redirect()->to('admin/bpd/detail/' . $bpdId)
            ->with('success', $msg);
    }

    public function deletePendidikanHistory()
    {
        $id    = $this->request->getPost('id');
        // Ambil ID parent untuk validasi (opsional)
        $bpdId = $this->request->getPost('bpd_id') ?? $this->request->getPost('perangkat_id');

        if (!$id) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'ID tidak valid',
                'newToken' => csrf_hash(),
            ]);
        }

        $row = $this->histPendidikanModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data riwayat pendidikan tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->histPendidikanModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Riwayat pendidikan berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }

    // ==========================
    // CRUD RIWAYAT JABATAN
    // ==========================

    public function saveJabatanHistory()
    {
        $bpdId = $this->request->getPost('bpd_id') ?? $this->request->getPost('perangkat_id');
        $id    = $this->request->getPost('id');

        if (!$bpdId) {
            return redirect()->back()->with('error', 'Data BPD tidak valid');
        }

        $data = [
            'bpd_id'      => $bpdId, // Column database harus bpd_id
            'jabatan_id'  => $this->request->getPost('jabatan_id') ?: null,
            'nama_unit'   => $this->request->getPost('nama_unit'),
            'sk_nomor'    => $this->request->getPost('sk_nomor'),
            'sk_tanggal'  => $this->request->getPost('sk_tanggal') ?: null,
            'tmt_mulai'   => $this->request->getPost('tmt_mulai') ?: null,
            'tmt_selesai' => $this->request->getPost('tmt_selesai') ?: null,
            'keterangan'  => $this->request->getPost('keterangan'),
        ];

        $file = $this->request->getFile('sk_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mime    = $file->getMimeType();
            $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'application/pdf'];

            if (!in_array($mime, $allowed, true)) {
                return redirect()->back()
                    ->with('error', 'File SK harus berupa JPG, PNG, WEBP, atau PDF');
            }

            $uploadPath = WRITEPATH . 'uploads/sk/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            $data['sk_file'] = 'sk/' . $newName;
        } else {
            $data['sk_file'] = $this->request->getPost('sk_file_old') ?: null;
        }

        if ($id) {
            $this->histJabatanModel->update($id, $data);
            $msg = 'Riwayat jabatan berhasil diperbarui';
        } else {
            $this->histJabatanModel->insert($data);
            $msg = 'Riwayat jabatan berhasil ditambahkan';
        }

        return redirect()->to('admin/bpd/detail/' . $bpdId)
            ->with('success', $msg);
    }

    public function deleteJabatanHistory()
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'ID tidak valid',
                'newToken' => csrf_hash(),
            ]);
        }

        $row = $this->histJabatanModel->find($id);
        if (!$row) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data riwayat jabatan tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->histJabatanModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Riwayat jabatan berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }

    // ==========================
    // HELPERS
    // ==========================

    private function getPendidikanOptions(): array
    {
        return $this->db->table('master_pendidikan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();
    }

    private function getJabatanOptions(): array
    {
        return $this->db->table('master_jabatan')
            ->where('deleted_at', null)
            ->where('is_active', 1)
            ->orderBy('urut', 'ASC')
            ->get()
            ->getResultArray();
    }
}
