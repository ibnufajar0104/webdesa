<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterPekerjaanModel extends Model
{
    protected $table            = 'master_pekerjaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'nama_pekerjaan',
        'kode_pekerjaan',
        'urut',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
