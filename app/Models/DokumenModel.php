<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table            = 'dokumen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kategori_id',
        'judul',
        'slug',
        'nomor',
        'tahun',
        'tanggal',
        'ringkasan',
        'file_path',
        'file_name',
        'mime',
        'size',
        'views',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
