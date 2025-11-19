<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterJabatanModel extends Model
{
    protected $table            = 'master_jabatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'nama_jabatan',
        'kode_jabatan',
        'urut',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
