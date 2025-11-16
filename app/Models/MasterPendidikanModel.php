<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterPendidikanModel extends Model
{
    protected $table            = 'master_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'nama_pendidikan',
        'kode_pendidikan',
        'urut',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
