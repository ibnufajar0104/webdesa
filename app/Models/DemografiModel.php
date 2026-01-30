<?php

namespace App\Models;

use CodeIgniter\Model;

class DemografiModel extends Model
{
    protected $table            = 'demografi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'jarak_ke_kabupaten',
        'luas_wilayah',
        'kepadatan'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
