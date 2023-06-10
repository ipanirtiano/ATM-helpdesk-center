<?php

namespace App\Models;

use CodeIgniter\Model;

class TeknisiModel extends Model
{
    protected $table = 'teknisi';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_tek', 'kode_user', 'kategori', 'area_tugas', 'created_at', 'updated_at'];

    public function getNumRows()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM teknisi");
        $count = mysqli_num_rows($query);

        return $count;
    }
}
