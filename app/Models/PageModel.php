<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table            = 'pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    // ✅ Aktifkan soft delete
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'slug',
        'title',
        'content',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ✅ Kolom soft delete
    protected $deletedField  = 'deleted_at';
}
