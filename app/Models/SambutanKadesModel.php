<?php

namespace App\Models;

use CodeIgniter\Model;

class SambutanKadesModel extends Model
{
    protected $table            = 'sambutan_kades';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'judul',
        'isi',
        'foto_kades',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
