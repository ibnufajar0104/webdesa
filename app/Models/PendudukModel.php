<?php

namespace App\Models;

use CodeIgniter\Model;

class PendudukModel extends Model
{
    protected $table            = 'penduduk';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'nik',
        'no_kk',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'agama_id',
        'status_perkawinan',
        'pendidikan_id',
        'pekerjaan_id',
        'kewarganegaraan',
        'status_penduduk',
        'status_dasar',
        'rt_id',
        'alamat',
        'desa',
        'kecamatan',
        'no_hp',
        'email',
        'ktp_file',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Kalau mau rules bawaan model:
    protected $validationRules = [
        'nik'           => 'required|exact_length[16]|numeric',
        'nama_lengkap'  => 'required|min_length[3]',
        'jenis_kelamin' => 'required|in_list[L,P]',
        'tanggal_lahir' => 'required|valid_date[Y-m-d]',
    ];
}
