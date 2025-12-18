<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $validation;

    public function __construct()
    {
        $this->userModel  = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function login()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(site_url('admin/dashboard'));
        }

        return view('auth/login', [
            'pageTitle' => 'Login',
            'errors'    => session('errors') ?? [],
        ]);
    }


    public function attempt()
    {
        if ($this->request->getMethod(true) !== 'POST') {
            return redirect()->to(site_url('login'));
        }

        $rules = [
            'identity' => 'required|min_length[3]|max_length[120]',
            'password' => 'required|min_length[6]|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors())
                ->with('error', 'Lengkapi data login.');
        }

        $identity = trim((string) $this->request->getPost('identity'));
        $password = (string) $this->request->getPost('password');

        $user = $this->userModel
            ->groupStart()
            ->where('username', $identity)
            ->orWhere('email', $identity)
            ->groupEnd()
            ->where('deleted_at', null)
            ->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Akun tidak ditemukan.');
        }

        if ((int)($user['is_active'] ?? 0) !== 1) {
            return redirect()->back()->withInput()->with('error', 'Akun nonaktif.');
        }

        if (!password_verify($password, (string)($user['password_hash'] ?? ''))) {
            return redirect()->back()->withInput()->with('error', 'Username/Email atau password salah.');
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'nama'       => $user['nama'],
            'username'   => $user['username'],
            'role'       => $user['role'],
        ]);

        $this->userModel->update($user['id'], [
            'last_login_at' => date('Y-m-d H:i:s'),
        ]);

        $redirect = session()->get('redirect_url');
        session()->remove('redirect_url');

        return redirect()->to($redirect ?: site_url('admin/dashboard'));
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Berhasil logout.');
    }
}
