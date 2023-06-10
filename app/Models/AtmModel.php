<?php

namespace App\Models;

use CodeIgniter\Model;

class AtmModel extends Model
{
    protected $table = 'atm';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_atm', 'nama_atm', 'alamat', 'Area', 'created_at', 'updated_at'];

    public function getNumRows()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM atm");
        $count = mysqli_num_rows($query);

        return $count;
    }
}
