<?php

namespace App\Models;

use CodeIgniter\Model;

class BpdPendidikanHistoryModel extends Model
{
    protected $table            = 'bpd_pendidikan_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'perangkat_id',
        'pendidikan_id',
        'nama_lembaga',
        'jurusan',
        'tahun_masuk',
        'tahun_lulus',
        'ijazah_file',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
