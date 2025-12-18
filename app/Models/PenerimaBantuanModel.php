<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaBantuanModel extends Model
{
    protected $table            = 'penerima_bantuan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'penduduk_id',
        'bantuan_id',
        'tahun',
        'periode',
        'tanggal_terima',
        'nominal',
        'status',
        'keterangan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
