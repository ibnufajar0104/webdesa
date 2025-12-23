<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class Menu extends BaseController
{
    protected MenuModel $menu;

    public function __construct()
    {
        $this->menu = new MenuModel();
    }

    /**
     * GET /api/menu
     * Return tree menu (aktif saja) untuk frontend navbar.
     *
     * Query:
     * - include_inactive=1  (opsional, default 0)
     */
    public function index()
    {
        $includeInactive = (int) ($this->request->getGet('include_inactive') ?? 0) === 1;

        // Ambil semua menu (flat) urut parent lalu sort_order
        $builder = $this->menu->builder()
            ->select('id, parent_id, label, url, target, is_active, sort_order')
            ->orderBy('parent_id', 'ASC')
            ->orderBy('sort_order', 'ASC');

        if (!$includeInactive) {
            $builder->where('is_active', 1);
        }

        $rows = $builder->get()->getResultArray();

        // Build tree
        $tree = $this->buildTree($rows);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $tree,
        ]);
    }

    /**
     * GET /api/menu/flat
     * Return flat list menu (berguna untuk debug/opsional).
     *
     * Query:
     * - include_inactive=1
     */
    public function flat()
    {
        $includeInactive = (int) ($this->request->getGet('include_inactive') ?? 0) === 1;

        $builder = $this->menu->builder()
            ->select('id, parent_id, label, url, target, is_active, sort_order')
            ->orderBy('parent_id', 'ASC')
            ->orderBy('sort_order', 'ASC');

        if (!$includeInactive) {
            $builder->where('is_active', 1);
        }

        $rows = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    /**
     * GET /api/menu/by-parent/{parentId}
     * Return children dari parent tertentu (opsional, kalau frontend butuh lazy-load).
     */
    public function byParent($parentId = null)
    {
        $parentId = ($parentId === null || $parentId === '') ? null : (int) $parentId;

        $rows = $this->menu->builder()
            ->select('id, parent_id, label, url, target, is_active, sort_order')
            ->where('is_active', 1)
            ->where('parent_id', $parentId)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $rows,
        ]);
    }

    /**
     * Build nested tree:
     * [
     *   {id,label,url,target,children:[...]},
     *   ...
     * ]
     */
    private function buildTree(array $rows): array
    {
        // Normalisasi parent_id => null kalau kosong
        foreach ($rows as &$r) {
            if ($r['parent_id'] === '' || $r['parent_id'] === null) {
                $r['parent_id'] = null;
            } else {
                $r['parent_id'] = (int) $r['parent_id'];
            }
            $r['id'] = (int) $r['id'];
            $r['is_active'] = (int) $r['is_active'];
            $r['sort_order'] = (int) $r['sort_order'];
            $r['children'] = [];
        }
        unset($r);

        // Index by id
        $byId = [];
        foreach ($rows as $r) {
            $byId[$r['id']] = $r;
        }

        // Attach children
        $tree = [];
        foreach ($byId as $id => $item) {
            $pid = $item['parent_id'];

            if ($pid === null) {
                $tree[] = &$byId[$id];
            } else {
                // kalau parent hilang (data kacau), anggap root
                if (!isset($byId[$pid])) {
                    $tree[] = &$byId[$id];
                } else {
                    $byId[$pid]['children'][] = &$byId[$id];
                }
            }
        }
        unset($item);

        // rapikan: hapus field internal kalau mau (opsional)
        $tree = $this->cleanupTree($tree);

        return $tree;
    }

    private function cleanupTree(array $nodes): array
    {
        $out = [];
        foreach ($nodes as $n) {
            $out[] = [
                'id'         => (int) $n['id'],
                'parent_id'  => $n['parent_id'],
                'label'      => $n['label'],
                'url'        => $n['url'],
                'target'     => $n['target'] ?: '_self',
                'sort_order' => (int) $n['sort_order'],
                'children'   => !empty($n['children']) ? $this->cleanupTree($n['children']) : [],
            ];
        }
        return $out;
    }
}
