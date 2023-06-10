<?php

namespace App\Controllers;

use App\Models\AtmModel;
use App\Models\AuthModel;
use App\Models\DepartemenModel;
use App\Models\KaryawanModel;
use App\Models\KategoriModel;
use App\Models\TeknisiModel;

class Atm extends BaseController
{

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->userModel = new AuthModel();
        $this->departemenModel = new DepartemenModel();
        $this->teknisiModel = new TeknisiModel();
        $this->kategoriModel = new KategoriModel();
        $this->atmModel = new AtmModel();
    }



    public function index()
    {
        //generet kode users random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate users dept random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode users yang sudah di random
        $kode_users = 'ATM-' . $generetKode1 . $generetKode2;

        // get data atm
        $atm = $this->atmModel->findAll();


        $data = [
            'tittle' => 'Data ATM',
            'kode_tek' => $kode_users,
            'atm' => $atm,
            'validation' => \Config\Services::validation(),
        ];
        return view('atm/index', $data);
    }


    public function proses_input()
    {
        if (!$this->validate([
            'kode_atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode ATM Harus Di Lengkapi!'
                ]
            ],
            'nama_atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama ATM Harus Di Lengkapi!'
                ]
            ],
            'alamat_atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat ATM Harus Di Lengkapi!'
                ]
            ],
            'area' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Area ATM Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/atm'))->withInput();
        } else {
            // insert data kedalam table teknisi
            $this->atmModel->save([
                'kode_atm' => $this->request->getVar('kode_atm'),
                'nama_atm' => $this->request->getVar('nama_atm'),
                'alamat' => $this->request->getVar('alamat_atm'),
                'area' => $this->request->getVar('area')
            ]);

            session()->setFlashdata('pesan', 'Data ATM Berhasil di Tambah!');
            return redirect()->to(base_url('/admin/atm'));
        }
    }

    public function update($kode_atm)
    {
        $kodeTek = base64_decode($kode_atm);

        // get data atm
        $data_atm = $this->atmModel->where('kode_atm', $kodeTek)->first();


        $data = [
            'tittle' => 'Update Data ATM',
            'data_atm' => $data_atm,
            'validation' => \Config\Services::validation(),
        ];

        return view('atm/update', $data);
    }

    public function proses_update($kode_atm)
    {
        $kodeATM = base64_decode($kode_atm);

        // get data teknisi 
        $data_atm = $this->atmModel->where('kode_atm', $kodeATM)->first();
        // get id data teknisi
        $id_atm = $data_atm['id'];

        // valdiasi form
        if (!$this->validate([
            'kode_atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode ATM Harus Di Lengkapi!'
                ]
            ],
            'nama_atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama ATM Harus Di Lengkapi!'
                ]
            ],
            'alamat_atm' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat ATM Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/update-atm/' . $kode_atm))->withInput();
        } else {
            // update data table tenkisi by id
            $this->atmModel->save([
                'id' => $id_atm,
                'nama_atm' => $this->request->getVar('nama_atm'),
                'alamat' => $this->request->getVar('alamat_atm'),
            ]);
            session()->setFlashdata('pesan', 'Data ATM Berhasil di Update!');
            return redirect()->to(base_url('/admin/atm'));
        }
    }


    public function hapus($kode_atm)
    {
        $kodeATM = base64_decode($kode_atm);

        // get data atm yang akan di hapus
        $data_atm = $this->atmModel->where('kode_atm', $kodeATM)->first();
        // get ID data teknisi
        $id_atm = $data_atm['id'];

        // delete data atm dari table teknisi
        $this->atmModel->delete($id_atm);

        session()->setFlashdata('pesan', 'Data ATM Berhasil di Hapus!');
        return redirect()->to(base_url('/admin/atm'))->withInput();
    }
}
