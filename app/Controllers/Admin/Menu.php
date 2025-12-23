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
            'pageTitle'  => 'Manajemen Menu',
            'menus'      => $this->menu->orderBy('parent_id', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
            'parents'    => $this->menu->where('parent_id', null)->orderBy('sort_order', 'ASC')->findAll(),
            'activeMenu' => 'menu_manage',
        ];
        return view('admin/menu/index', $data);
    }

    public function save()
    {
        $id = (int)($this->request->getPost('id') ?? 0);

        $rules = [
            'label'     => 'required|min_length[2]|max_length[120]',
            'parent_id' => 'permit_empty|integer',
            'url'       => 'permit_empty|max_length[255]',
            'target'    => 'permit_empty|in_list[_self,_blank]',
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
            'parent_id' => $parentId,
            'label'     => trim((string)$this->request->getPost('label')),
            'url'       => trim((string)$this->request->getPost('url')),
            'target'    => (string)($this->request->getPost('target') ?: '_self'),
            'is_active' => (int)$this->request->getPost('is_active'),
        ];

        if (!$id) {
            $data['sort_order'] = $this->menu->nextOrder($parentId);
            $this->menu->insert($data);
        } else {
            $this->menu->update($id, $data);
        }

        return $this->response->setJSON(['status' => true, 'msg' => 'Menu tersimpan.']);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $this->menu->where('parent_id', $id)->delete(); // hapus anak
        $this->menu->delete($id);

        return $this->response->setJSON(['status' => true, 'msg' => 'Menu dihapus.']);
    }

    // GANTI toggle -> setActive (lebih cocok untuk dropdown aktif/nonaktif)
    public function setActive($id)
    {
        $id = (int)$id;
        $row = $this->menu->find($id);
        if (!$row) {
            return $this->response->setJSON(['status' => false, 'msg' => 'Data tidak ditemukan'])->setStatusCode(404);
        }

        $payload = $this->request->getJSON(true) ?? [];
        $isActive = isset($payload['is_active']) ? (int)$payload['is_active'] : null;
        if (!in_array($isActive, [0, 1], true)) {
            return $this->response->setJSON(['status' => false, 'msg' => 'Nilai status tidak valid'])->setStatusCode(422);
        }

        $this->menu->update($id, ['is_active' => $isActive]);

        return $this->response->setJSON(['status' => true, 'msg' => 'Status diperbarui', 'is_active' => $isActive]);
    }

    public function reorder()
    {
        $payload = $this->request->getJSON(true);
        $items = $payload['items'] ?? [];

        $this->menu->db->transStart();
        foreach ($items as $it) {
            $this->menu->update((int)$it['id'], [
                'parent_id'  => ($it['parent_id'] === null || $it['parent_id'] === '') ? null : (int)$it['parent_id'],
                'sort_order' => (int)$it['sort_order'],
            ]);
        }
        $this->menu->db->transComplete();

        return $this->response->setJSON(['status' => true, 'msg' => 'Urutan tersimpan (realtime).']);
    }

    public function show($id)
    {
        $row = $this->menu->find((int)$id);

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'msg'    => 'Menu tidak ditemukan',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $row,
        ]);
    }
}
