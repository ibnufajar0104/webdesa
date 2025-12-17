<?php

namespace App\Models;

use CodeIgniter\Model;

class RtIdentitasModel extends Model
{
    protected $table            = 'rt_identitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'rt_id',
        'nama_ketua',
        'nik_ketua',
        'no_hp_ketua',
        'email_ketua',
        'alamat_sekretariat',
        'sk_nomor',
        'sk_tanggal',
        'tmt_mulai',
        'tmt_selesai',
        'keterangan',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
