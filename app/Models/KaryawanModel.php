<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_user', 'nama_lengkap', 'email', 'phone', 'departemen', 'created_at', 'updated_at'];

    public function getNumRows()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM karyawan");
        $count = mysqli_num_rows($query);

        return $count;
    }
}
