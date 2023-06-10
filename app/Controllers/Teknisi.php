<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\DepartemenModel;
use App\Models\KaryawanModel;
use App\Models\KategoriModel;
use App\Models\TeknisiModel;

class Teknisi extends BaseController
{

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->userModel = new AuthModel();
        $this->departemenModel = new DepartemenModel();
        $this->teknisiModel = new TeknisiModel();
        $this->kategoriModel = new KategoriModel();
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
        $kode_users = 'TEK-' . $generetKode1 . $generetKode2;

        // get data karyawan model
        $teknisi = $this->teknisiModel->findAll();
        $karyawan = $this->userModel->where('level', 'Teknisi')->findAll();

        $data = [
            'tittle' => 'Data Teknisi',
            'kode_tek' => $kode_users,
            'teknisi' => $teknisi,
            'karyawan' => $karyawan,
            'kategori' => $this->kategoriModel->findAll(),
            'validation' => \Config\Services::validation(),
            'departemen' => $this->departemenModel->findAll()
        ];
        return view('karyawan/teknisi', $data);
    }

    public function index2()
    {
        // get data karyawan model
        $teknisi = $this->teknisiModel->findAll();
        $karyawan = $this->userModel->where('level', 'Teknisi')->findAll();

        $data = [
            'tittle' => 'Data Teknisi',
            'teknisi' => $teknisi,
            'karyawan' => $karyawan,
            'kategori' => $this->kategoriModel->findAll(),
            'validation' => \Config\Services::validation(),
            'departemen' => $this->departemenModel->findAll()
        ];
        return view('karyawan/teknisi2', $data);
    }

    public function proses_input()
    {
        if (!$this->validate([
            'kode_tek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Teknisi Harus Di Lengkapi!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap Harus Di Lengkapi!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kategori!'
                ]
            ],
            'area' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Area Tugas!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/teknisi'))->withInput();
        } else {
            // insert data kedalam table teknisi
            $this->teknisiModel->save([
                'kode_tek' => $this->request->getVar('kode_tek'),
                'kode_user' => $this->request->getVar('nama_lengkap'),
                'kategori' => $this->request->getVar('kategori'),
                'area_tugas' => $this->request->getVar('area')
            ]);

            session()->setFlashdata('pesan', 'Data Teknisi Berhasil di Tambah!');
            return redirect()->to(base_url('/admin/teknisi'));
        }
    }

    public function update($kode_teknisi)
    {
        $kodeTek = base64_decode($kode_teknisi);

        // get data teknisi
        $data_teknisi = $this->teknisiModel->where('kode_tek', $kodeTek)->first();

        // get data karyawan model
        $teknisi = $this->teknisiModel->findAll();
        $karyawan = $this->userModel->where('level', 'Teknisi')->findAll();

        $data = [
            'tittle' => 'Update Teknisi',
            'data_teknisi' => $data_teknisi,
            'validation' => \Config\Services::validation(),
            'teknisi' => $teknisi,
            'karyawan' => $karyawan,
            'kategori' => $this->kategoriModel->findAll(),
        ];

        return view('karyawan/update_teknisi', $data);
    }

    public function proses_update($kode_teknisi)
    {
        $kodeTek = base64_decode($kode_teknisi);

        // get data teknisi 
        $data_tek = $this->teknisiModel->where('kode_tek', $kodeTek)->first();
        // get id data teknisi
        $id_tek = $data_tek['id'];

        // valdiasi form
        if (!$this->validate([
            'kode_tek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Teknisi Harus Di Lengkapi!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap Harus Di Lengkapi!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kategori!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/update-teknisi/' . $kode_teknisi))->withInput();
        } else {
            // update data table tenkisi by id
            $this->teknisiModel->save([
                'id' => $id_tek,
                'kode_user' => $this->request->getVar('nama_lengkap'),
                'kategori' => $this->request->getVar('kategori'),
            ]);
            session()->setFlashdata('pesan', 'Data Teknisi Berhasil di Update!');
            return redirect()->to(base_url('/admin/teknisi'));
        }
    }


    public function hapus($kode_teknisi)
    {
        $kodeTek = base64_decode($kode_teknisi);

        // get data teknisi yang akan di hapus
        $data_teknisi = $this->teknisiModel->where('kode_tek', $kodeTek)->first();
        // get ID data teknisi
        $id_tek = $data_teknisi['id'];

        // delete data teknisi dari table teknisi
        $this->teknisiModel->delete($id_tek);

        session()->setFlashdata('pesan', 'Data Teknisi Berhasil di Hapus!');
        return redirect()->to(base_url('/admin/teknisi'))->withInput();
    }
}
