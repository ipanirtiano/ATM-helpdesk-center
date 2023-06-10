<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_kategori', 'nama_kategori', 'created_at', 'updated_at'];
}
