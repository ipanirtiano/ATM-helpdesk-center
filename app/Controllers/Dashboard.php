<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\TeknisiModel;
use App\Models\TicketModel;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->teknisiModel = new TeknisiModel();
        $this->ticketModel = new TicketModel();
    }


    public function index()
    {
        // get total user 
        $karyawan = $this->karyawanModel->getNumRows();
        $teknisi = $this->teknisiModel->getNumRows();
        $ticket = $this->ticketModel->getNumRows();
        $my_ticket = $this->ticketModel->my_ticket(session('kode_user'));
        $ticket_terkirim = $this->ticketModel->terkirim();
        $ticket_waiting = $this->ticketModel->waiting();
        $ticket_proses = $this->ticketModel->proses();
        $ticket_solved = $this->ticketModel->solved();

        $data = [
            'tittle' => 'Dashboard | Home',
            'karyawan' => $karyawan,
            'teknisi' => $teknisi,
            'ticket' => $ticket,
            'my_ticket' => $my_ticket,
            'terkirim' => $ticket_terkirim,
            'waiting' => $ticket_waiting,
            'proses' => $ticket_proses,
            'solved' => $ticket_solved
        ];
        return view('Dashboard/index', $data);
    }
}
