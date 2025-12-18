<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class Menu extends BaseController
{
    protected MenuModel $menu;

    public function __construct()
    {
        $this->menu = new MenuModel();
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Manajemen Menu',
            'menus'     => $this->menu->orderBy('parent_id', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
            'parents'   => $this->menu->where('parent_id', null)->where('is_header', 0)->orderBy('sort_order', 'ASC')->findAll(),
            'activeMenu' => 'menu_manage',
        ];
        return view('admin/menu/index', $data);
    }

    public function save()
    {
        // if ($this->request->getMethod() !== 'post') {
        //     return $this->response->setStatusCode(405);
        // }

        $id = (int)($this->request->getPost('id') ?? 0);

        $rules = [
            'label'     => 'required|min_length[2]|max_length[120]',
            'parent_id' => 'permit_empty|integer',
            'url'       => 'permit_empty|max_length[255]',
            'is_header' => 'required|in_list[0,1]',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (! $this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'msg'    => 'Validasi gagal.',
                'errors' => $this->validator->getErrors(),
            ])->setStatusCode(422);
        }

        $parentId = $this->request->getPost('parent_id');
        $parentId = ($parentId === '' || $parentId === null) ? null : (int)$parentId;

        $data = [
            'parent_id'   => $parentId,
            'label'       => trim((string)$this->request->getPost('label')),
            'url'         => trim((string)$this->request->getPost('url')),
            'is_header'   => (int)$this->request->getPost('is_header'),
            'is_active'   => (int)$this->request->getPost('is_active'),
            'roles'       => trim((string)$this->request->getPost('roles')), // "admin,desa"
        ];

        if (!$id) {
            $data['sort_order'] = $this->menu->nextOrder($parentId);
            $this->menu->insert($data);
        } else {
            $this->menu->update($id, $data);
        }

        return $this->response->setJSON([
            'status' => true,
            'msg'    => 'Menu tersimpan.',
        ]);
    }

    public function delete($id)
    {
        $id = (int)$id;
        // hapus anak dulu
        $this->menu->where('parent_id', $id)->delete();
        $this->menu->delete($id);

        return $this->response->setJSON(['status' => true, 'msg' => 'Menu dihapus.']);
    }

    public function toggle($id)
    {
        $id = (int)$id;
        $row = $this->menu->find($id);
        if (!$row) return $this->response->setJSON(['status' => false, 'msg' => 'Data tidak ditemukan'])->setStatusCode(404);

        $next = $row['is_active'] ? 0 : 1;
        $this->menu->update($id, ['is_active' => $next]);

        return $this->response->setJSON(['status' => true, 'msg' => 'Status diperbarui', 'is_active' => $next]);
    }

    public function reorder()
    {
        // if (!$this->request->isAJAX()) return $this->response->setStatusCode(405);

        $payload = $this->request->getJSON(true);
        $items = $payload['items'] ?? [];

        // items: [{id:1,parent_id:null,sort_order:1}, ...]
        $this->menu->db->transStart();
        foreach ($items as $it) {
            $this->menu->update((int)$it['id'], [
                'parent_id'  => $it['parent_id'] === null ? null : (int)$it['parent_id'],
                'sort_order' => (int)$it['sort_order'],
            ]);
        }
        $this->menu->db->transComplete();

        return $this->response->setJSON(['status' => true, 'msg' => 'Urutan menu disimpan.']);
    }
}
