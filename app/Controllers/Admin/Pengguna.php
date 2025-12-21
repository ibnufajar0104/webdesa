<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Pengguna extends BaseController
{
    protected $userModel;
    protected $db;
    protected $validation;

    public function __construct()
    {
        $this->userModel   = new UserModel();
        $this->db          = \Config\Database::connect();
        $this->validation  = \Config\Services::validation();
    }

    public function index()
    {
        return view('admin/pengguna/index', [
            'pageTitle'  => 'Pengguna',
            'activeMenu' => 'pengguna',
            'roleList'   => $this->roleList(),
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
            2 => 'username',
            3 => 'email',
            4 => 'role',
            5 => 'is_active',
            6 => 'last_login_at',
        ];
        $orderColumn = $columns[$orderColumnIdx] ?? 'nama';

        $filterRole   = $request->getPost('filter_role');
        $filterStatus = $request->getPost('filter_status');

        $builder = $this->db->table('users');
        $builder->select('users.*');
        $builder->where('users.deleted_at', null);

        // total (soft delete only)
        $recordsTotal = $this->userModel
            ->where('deleted_at', null)
            ->countAllResults();

        // filter role
        if (!empty($filterRole) && in_array($filterRole, array_keys($this->roleList()), true)) {
            $builder->where('users.role', $filterRole);
        }

        // filter status
        if ($filterStatus !== null && $filterStatus !== '') {
            $builder->where('users.is_active', (int) $filterStatus);
        }

        // search
        if ($search !== '') {
            $builder->groupStart()
                ->like('users.nama', $search)
                ->orLike('users.username', $search)
                ->orLike('users.email', $search)
                ->orLike('users.no_hp', $search)
                ->orLike('users.role', $search)
                ->groupEnd();
        }

        $recordsFiltered = $builder->countAllResults(false);

        $builder->orderBy('users.' . $orderColumn, $orderDir)
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
        $user = [
            'id'        => '',
            'nama'      => old('nama'),
            'username'  => old('username'),
            'email'     => old('email'),
            'no_hp'     => old('no_hp'),
            'role'      => old('role') ?: 'admin',
            'is_active' => old('is_active') ?? 1,
        ];

        return view('admin/pengguna/form', [
            'pageTitle'  => 'Tambah Pengguna',
            'activeMenu' => 'pengguna',
            'mode'       => 'create',
            'user'       => $user,
            'roleList'   => $this->roleList(),
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function edit($id)
    {
        $row = $this->userModel->find($id);

        if (!$row || !empty($row['deleted_at'])) {
            return redirect()->to('admin/pengguna')->with('error', 'Data pengguna tidak ditemukan');
        }

        $user = [
            'id'        => $row['id'],
            'nama'      => old('nama', $row['nama']),
            'username'  => old('username', $row['username']),
            'email'     => old('email', $row['email']),
            'no_hp'     => old('no_hp', $row['no_hp']),
            'role'      => old('role', $row['role']),
            'is_active' => old('is_active', $row['is_active']),
        ];

        return view('admin/pengguna/form', [
            'pageTitle'  => 'Edit Pengguna',
            'activeMenu' => 'pengguna',
            'mode'       => 'edit',
            'user'       => $user,
            'roleList'   => $this->roleList(),
            'errors'     => session('errors') ?? [],
        ]);
    }



    public function profile()
    {

        $id = session()->user_id;
        $row = $this->userModel->find($id);

        if (!$row || !empty($row['deleted_at'])) {
            return redirect()->to('admin/pengguna')->with('error', 'Data pengguna tidak ditemukan');
        }

        $user = [
            'id'        => $row['id'],
            'nama'      => old('nama', $row['nama']),
            'username'  => old('username', $row['username']),
            'email'     => old('email', $row['email']),
            'no_hp'     => old('no_hp', $row['no_hp']),
            'role'      => old('role', $row['role']),
            'is_active' => old('is_active', $row['is_active']),
        ];

        return view('admin/pengguna/profile', [
            'pageTitle'  => 'Edit Pengguna',
            'activeMenu' => 'pengguna',
            'mode'       => 'edit',
            'user'       => $user,
            'roleList'   => $this->roleList(),
            'errors'     => session('errors') ?? [],
        ]);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $role = (string) $this->request->getPost('role');
        if (!array_key_exists($role, $this->roleList())) {
            $role = 'admin';
        }

        $rules = [
            'nama'     => 'required|min_length[3]|max_length[150]',
            'username' => 'required|min_length[3]|max_length[60]',
            'email'    => 'permit_empty|valid_email|max_length[120]',
            'no_hp'    => 'permit_empty|max_length[30]',
            'role'     => 'required',
            'is_active' => 'required|in_list[0,1]',
        ];

        // password rules
        $password = (string) $this->request->getPost('password');
        $password2 = (string) $this->request->getPost('password_confirm');

        if (!$id) {
            // create wajib password
            $rules['password'] = 'required|min_length[6]';
        } else {
            // edit: password opsional
            if ($password !== '') {
                $rules['password'] = 'min_length[6]';
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // validasi confirm password kalau diisi
        if (($password !== '') || (!$id)) {
            if ($password !== $password2) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['Konfirmasi password tidak sama.']);
            }
        }

        $username = trim((string) $this->request->getPost('username'));
        $email    = trim((string) $this->request->getPost('email'));

        // cek unik username
        $existsUsername = $this->userModel
            ->where('username', $username)
            ->where('deleted_at', null)
            ->first();

        if ($existsUsername && (string)$existsUsername['id'] !== (string)$id) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['Username sudah digunakan.']);
        }

        // cek unik email (kalau diisi)
        if ($email !== '') {
            $existsEmail = $this->userModel
                ->where('email', $email)
                ->where('deleted_at', null)
                ->first();

            if ($existsEmail && (string)$existsEmail['id'] !== (string)$id) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['Email sudah digunakan.']);
            }
        }

        $data = [
            'nama'      => trim((string) $this->request->getPost('nama')),
            'username'  => $username,
            'email'     => ($email === '') ? null : $email,
            'no_hp'     => trim((string) $this->request->getPost('no_hp')) ?: null,
            'role'      => $role,
            'is_active' => (int) $this->request->getPost('is_active'),
        ];

        if (($password !== '') || (!$id)) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($id) {
            $this->userModel->update($id, $data);
            return redirect()->to('admin/pengguna')->with('success', 'Pengguna berhasil diperbarui');
        }

        $this->userModel->insert($data);
        return redirect()->to('admin/pengguna')->with('success', 'Pengguna berhasil ditambahkan');
    }


    public function save_profile()
    {
        $id = $this->request->getPost('id');

        $role = (string) $this->request->getPost('role');
        if (!array_key_exists($role, $this->roleList())) {
            $role = 'admin';
        }

        $rules = [
            'nama'     => 'required|min_length[3]|max_length[150]',
            'username' => 'required|min_length[3]|max_length[60]',
            'email'    => 'permit_empty|valid_email|max_length[120]',
            'no_hp'    => 'permit_empty|max_length[30]'
        ];

        // password rules
        $password = (string) $this->request->getPost('password');
        $password2 = (string) $this->request->getPost('password_confirm');




        if ($password !== '') {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // validasi confirm password kalau diisi
        if (($password !== '') || (!$id)) {
            if ($password !== $password2) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['Konfirmasi password tidak sama.']);
            }
        }

        $username = trim((string) $this->request->getPost('username'));
        $email    = trim((string) $this->request->getPost('email'));

        // cek unik username
        $existsUsername = $this->userModel
            ->where('username', $username)
            ->where('deleted_at', null)
            ->first();

        if ($existsUsername && (string)$existsUsername['id'] !== (string)$id) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['Username sudah digunakan.']);
        }

        // cek unik email (kalau diisi)
        if ($email !== '') {
            $existsEmail = $this->userModel
                ->where('email', $email)
                ->where('deleted_at', null)
                ->first();

            if ($existsEmail && (string)$existsEmail['id'] !== (string)$id) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['Email sudah digunakan.']);
            }
        }

        $data = [
            'nama'      => trim((string) $this->request->getPost('nama')),
            'username'  => $username,
            'email'     => ($email === '') ? null : $email,
            'no_hp'     => trim((string) $this->request->getPost('no_hp')) ?: null
        ];

        if (($password !== '') || (!$id)) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($id) {
            $this->userModel->update($id, $data);
            return redirect()->to('admin/profile')->with('success', 'Pengguna berhasil diperbarui');
        }
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

        $row = $this->userModel->find($id);
        if (!$row || !empty($row['deleted_at'])) {
            return $this->response->setJSON([
                'status'   => false,
                'message'  => 'Data pengguna tidak ditemukan',
                'newToken' => csrf_hash(),
            ]);
        }

        $this->userModel->delete($id);

        return $this->response->setJSON([
            'status'   => true,
            'message'  => 'Pengguna berhasil dihapus',
            'newToken' => csrf_hash(),
        ]);
    }

    private function roleList(): array
    {
        return [
            'superadmin' => 'Super Admin',
            'admin'      => 'Admin',
        ];
    }
}
