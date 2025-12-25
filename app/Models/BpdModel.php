<?php

namespace App\Models;

use CodeIgniter\Model;

class BpdModel extends Model
{
    protected $table            = 'bpd';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'nama',
        'nip',
        'nik',
        'jenis_kelamin',
        'jabatan_id',
        'pendidikan_id',
        'tmt_jabatan',
        'status_aktif',
        'no_hp',
        'email',
        'alamat',
        'foto_file',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
