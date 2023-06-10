<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'ticket';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode_ticket', 'kode_pemesan', 'atm', 'tanggal', 'tgl_approve_teknisi', 'tanggal_proses', 'tanggal_solved', 'kategori', 'urgency', 'subject', 'deskripsi', 'kode_teknisi', 'status', 'progres', 'created_at', 'updated_at'];

    public function getNumRows()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM ticket");
        $count = mysqli_num_rows($query);

        return $count;
    }

    public function my_ticket($kode_user)
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM ticket WHERE kode_pemesan = '$kode_user'");
        $count = mysqli_num_rows($query);

        return $count;
    }

    public function terkirim()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM ticket WHERE status = 'Terkirim'");
        $count = mysqli_num_rows($query);

        return $count;
    }

    public function waiting()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM ticket WHERE status = 'Menunggu Teknisi'");
        $count = mysqli_num_rows($query);

        return $count;
    }

    public function proses()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM ticket WHERE status = 'Proses Teknisi'");
        $count = mysqli_num_rows($query);

        return $count;
    }

    public function solved()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'helpdesk');
        $query = mysqli_query($conn, "SELECT * FROM ticket WHERE status = 'Solved'");
        $count = mysqli_num_rows($query);

        return $count;
    }
}
