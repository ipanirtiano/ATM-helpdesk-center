<?php

namespace App\Controllers;

use App\Models\AtmModel;
use App\Models\AuthModel;
use App\Models\DepartemenModel;
use App\Models\KaryawanModel;
use App\Models\KategoriModel;
use App\Models\TeknisiModel;
use App\Models\TicketModel;

class Ticket extends BaseController
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->karyawanModel = new KaryawanModel();
        $this->userModel = new AuthModel();
        $this->departemenModel = new DepartemenModel();
        $this->kategoriModel = new KategoriModel();
        $this->ticketModel = new TicketModel();
        $this->teknisiModel = new TeknisiModel();
        $this->atmModel = new AtmModel();
    }

    public function index()
    {
        //generet kode ticket random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate ticket dept random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // generate ticket dept random 3 digit ketiga
        $angka_kode3 = range(0, 9);
        shuffle($angka_kode3);
        $ambilKode3 = array_rand($angka_kode3, 3);
        $generetKode3 = implode('', $ambilKode3);
        // kode ticket yang sudah di random
        $kode_ticket = 'T-' . $generetKode1 . $generetKode2 . $generetKode3;

        // get data karyawan model
        $karyawan = $this->karyawanModel->where('kode_user', session('kode_user'))->first();


        $data = [
            'tittle' => 'New Ticket',
            'karyawan' => $karyawan,
            'kode_tiket' => $kode_ticket,
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'atm' => $this->atmModel->findAll()
        ];
        return view('ticket/index', $data);
    }

    public function index2()
    {
        // get data ticket
        $data_ticket = $this->ticketModel->findAll();

        $data = [
            'tittle' => 'List Ticket',
            'ticket' => $data_ticket
        ];

        return view('ticket/index2', $data);
    }



    public function proses_input()
    {
        // validasi form input users
        if (!$this->validate([
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Kategori tidak boleh kosong!'
                ]
            ],
            'urgency' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih Urgency!'
                ]
            ],
            'subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Lengkapi Subject Masalah!'
                ]
            ],
            'atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Lengkapi ATM Area!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Lengkapi Deskripsi Masalah!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/views/new-ticket'))->withInput();
        } else {
            // insert data form users kedalam table guest
            $this->ticketModel->save([
                'kode_ticket' => $this->request->getVar('kode_ticket'),
                'kode_pemesan' => $this->request->getVar('kode_user'),
                'atm' => $this->request->getVar('atm'),
                'tanggal' => $this->request->getVar('tanggal'),
                'tanggal_proses' => 'Null',
                'tanggal_solved' => 'Null',
                'kategori' => $this->request->getVar('kategori'),
                'urgency' => $this->request->getVar('urgency'),
                'subject' => $this->request->getVar('subject'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'kode_teknisi' => 'Null',
                'status' => 'Terkirim',
                'pogres' => 'Null',
            ]);

            session()->setFlashdata('pesan', 'Pemesanan Ticket Berhasil di Tambah!');
            return redirect()->to(base_url('/views/my-ticket'));
        }
    }


    public function my_ticket()
    {
        // get data ticket
        $data_ticket = $this->ticketModel->where('kode_pemesan', session('kode_user'))->findAll();

        $data = [
            'tittle' => 'My Ticket',
            'ticket' => $data_ticket
        ];

        return view('ticket/my_ticket', $data);
    }

    public function assigment_ticket()
    {
        // get data ticket
        $data_ticket = $this->ticketModel->where('kode_teknisi', session('kode_user'))->findAll();

        $data = [
            'tittle' => 'Assigment Ticket',
            'ticket' => $data_ticket
        ];

        return view('ticket/assigment_ticket', $data);
    }

    public function ticket_detail($kode_ticket)
    {
        // get data ticket
        $ticket = $this->ticketModel->where('kode_ticket', $kode_ticket)->first();
        // get data pemesan
        $kode_pemesan = $ticket['kode_pemesan'];
        // get nama pemesan
        $pemesan = $this->karyawanModel->where('kode_user', $kode_pemesan)->first();
        // get data teknisi
        $kode_teknisi = $ticket['kode_teknisi'];
        // get nama teknisi
        $teknisi = $this->karyawanModel->where('kode_user', $kode_teknisi)->first();

        // get nama teknisi
        $data_teknisi = $this->karyawanModel->where('kode_user', $kode_teknisi)->first();
        // nama teknisi 
        $nama_teknisi = $data_teknisi['nama_lengkap'];
        // get phone teknisi
        $phone = $data_teknisi['phone'];

        $data = [
            'tittle' => 'Detail Ticket',
            'ticket' => $ticket,
            'pemesan' => $pemesan,
            'nama_teknisi' => $nama_teknisi,
            'phone' => $phone
        ];

        return view('ticket/detail_ticket', $data);
    }


    public function list_ticket()
    {
        // get data ticket
        $data_ticket = $this->ticketModel->findAll();

        $data = [
            'tittle' => 'List Ticket',
            'ticket' => $data_ticket
        ];

        return view('ticket/list_ticket', $data);
    }

    public function proses_ticket($kode_ticket)
    {
        // get data ticket
        $ticket = $this->ticketModel->where('kode_ticket', $kode_ticket)->first();
        // get data pemesan
        $kode_pemesan = $ticket['kode_pemesan'];
        // get nama pemesan
        $pemesan = $this->karyawanModel->where('kode_user', $kode_pemesan)->first();
        // get data teknisi
        $kode_teknisi = $ticket['kode_teknisi'];
        // get nama teknisi
        $teknisi = $this->teknisiModel->findAll();

        // get nama teknisi
        $data_teknisi = $this->karyawanModel->where('kode_user', $kode_teknisi)->first();
        // nama teknisi 
        $nama_teknisi = $data_teknisi['nama_lengkap'];
        // get phone teknisi
        $phone = $data_teknisi['phone'];





        $data = [
            'tittle' => 'Proses Ticket',
            'ticket' => $ticket,
            'pemesan' => $pemesan,
            'nama_teknisi' => $nama_teknisi,
            'teknisi' => $teknisi,
            'phone' => $phone,
            'validation' => \Config\Services::validation()
        ];


        return view('ticket/proses_ticket', $data);
    }


    public function accept_ticket($kode_ticket)
    {
        $kodeTik = base64_decode($kode_ticket);
        // get data ticket
        $data_ticket = $this->ticketModel->where('kode_ticket', $kodeTik)->first();
        // get ID ticket
        $id_ticket = $data_ticket['id'];

        // update data ticket
        $this->ticketModel->save([
            'id' => $id_ticket,
            'tgl_approve_teknisi' => date('Y-m-d H:i:s'),
            'status' => 'Proses Teknisi'
        ]);

        return redirect()->to(base_url('views/assigment-ticket'));
    }

    public function update_progres($kode_ticket)
    {
        // get data ticket
        $ticket = $this->ticketModel->where('kode_ticket', $kode_ticket)->first();
        // get data pemesan
        $kode_pemesan = $ticket['kode_pemesan'];
        // get nama pemesan
        $pemesan = $this->karyawanModel->where('kode_user', $kode_pemesan)->first();
        // get data teknisi
        $kode_teknisi = $ticket['kode_teknisi'];
        // get nama teknisi
        $teknisi = $this->teknisiModel->findAll();

        // get nama teknisi
        $data_teknisi = $this->karyawanModel->where('kode_user', $kode_teknisi)->first();
        // nama teknisi 
        $nama_teknisi = $data_teknisi['nama_lengkap'];


        $data = [
            'tittle' => 'Proses Ticket',
            'ticket' => $ticket,
            'pemesan' => $pemesan,
            'nama_teknisi' => $nama_teknisi,
            'teknisi' => $teknisi,
            'validation' => \Config\Services::validation()
        ];

        return view('ticket/proses_teknisi', $data);
    }

    public function proses_update_progres($kode_ticket)
    {
        // cek apakah progres sudah 100$
        if ($this->request->getVar('progres') == '100') {
            // get data ticket
            $data_ticket = $this->ticketModel->where('kode_ticket', $kode_ticket)->first();
            // get id ticket
            $id_ticket = $data_ticket['id'];

            // update ticket
            $this->ticketModel->save([
                'id' => $id_ticket,
                'tanggal_proses' => date('Y-m-d H:i:s'),
                'tanggal_solved' => date('Y-m-d H:i:s'),
                'status' => 'Solved',
                'progres' => $this->request->getVar('progres')
            ]);

            return redirect()->to(base_url('views/assigment-ticket'));
        } else {
            // get data ticket
            $data_ticket = $this->ticketModel->where('kode_ticket', $kode_ticket)->first();
            // get id ticket
            $id_ticket = $data_ticket['id'];

            // update ticket
            $this->ticketModel->save([
                'id' => $id_ticket,
                'tanggal_proses' => date('Y-m-d H:i:s'),
                'progres' => $this->request->getVar('progres')
            ]);

            return redirect()->to(base_url('views/update-progres/' . $kode_ticket));
        }
    }



    public function proses_update($kode_tiket)
    {
        // validate
        // validasi form input users
        if (!$this->validate([
            'teknisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Teknisi'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/proses-ticket/' . $kode_tiket))->withInput();
        } else {
            // update table ticket
            // get data ticket
            $data_ticket = $this->ticketModel->where('kode_ticket', $kode_tiket)->first();
            // get id ticket
            $id_ticket = $data_ticket['id'];

            $this->ticketModel->save([
                'id' => $id_ticket,
                'kode_teknisi' => $this->request->getVar('teknisi'),
                'status' => 'Menunggu Teknisi'
            ]);

            session()->setFlashdata('pesan', 'Ticket akan segera diproses!');
            return redirect()->to(base_url('/admin/proses-ticket/' . $kode_tiket))->withInput();
        }
    }


    public function hapus($kode_ticket)
    {
        // decript kode user
        $kodeTicket = base64_decode($kode_ticket);

        // get data ticket by kode ticket
        $data_ticket = $this->ticketModel->where('kode_ticket', $kodeTicket)->first();


        // get id karyawan
        $id_ticket = $data_ticket['id'];
        // delete data ticket
        $this->ticketModel->delete($id_ticket);


        // session flash data
        session()->setFlashdata('pesan', 'Data Ticket Berhasil di Hapus!');
        return redirect()->to(base_url('/views/my-ticket'))->withInput();
    }
}
