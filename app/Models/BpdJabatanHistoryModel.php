<?php

namespace App\Models;

use CodeIgniter\Model;

class BpdJabatanHistoryModel extends Model
{
    protected $table            = 'bpd_jabatan_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'perangkat_id',
        'jabatan_id',
        'nama_unit',
        'sk_nomor',
        'sk_tanggal',
        'tmt_mulai',
        'tmt_selesai',
        'sk_file',
        'keterangan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
