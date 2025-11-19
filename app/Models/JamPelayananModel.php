<?php

namespace App\Models;

use CodeIgniter\Model;

class JamPelayananModel extends Model
{
    protected $table            = 'jam_pelayanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
