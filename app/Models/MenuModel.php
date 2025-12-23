<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menus';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'parent_id',
        'label',
        'url',
        'sort_order',
        'is_active',
        'target'
    ];

    protected $useTimestamps = true;

    /**
     * Ambil menu berbentuk tree (parent + children)
     */
    public function getTree(): array
    {
        $rows = $this->where('is_active', 1)
            ->orderBy('parent_id', 'ASC')
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        $map = [];
        foreach ($rows as $row) {
            $row['children'] = [];
            $map[$row['id']] = $row;
        }

        $tree = [];
        foreach ($map as $id => $node) {
            if ($node['parent_id'] && isset($map[$node['parent_id']])) {
                $map[$node['parent_id']]['children'][] = &$map[$id];
            } else {
                $tree[] = &$map[$id];
            }
        }

        return $tree;
    }

    public function nextOrder(?int $parentId): int
    {
        $row = $this->selectMax('sort_order', 'mx')
            ->where('parent_id', $parentId)
            ->first();

        return ((int)($row['mx'] ?? 0)) + 1;
    }


    public function nextSortOrder(?int $parentId): int
    {
        return $this->nextOrder($parentId);
    }
}
