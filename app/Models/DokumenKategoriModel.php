<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenKategoriModel extends Model
{
    protected $table            = 'dokumen_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'nama',
        'slug',
        'deskripsi',
        'urutan',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
