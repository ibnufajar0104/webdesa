<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterAgamaModel extends Model
{
    protected $table            = 'master_agama';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'nama_agama',
        'kode_agama',
        'urut',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
