<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\DepartemenModel;
use App\Models\KaryawanModel;

class Karyawan extends BaseController
{

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->userModel = new AuthModel();
        $this->departemenModel = new DepartemenModel();
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
        $kode_users = 'USR-' . $generetKode1 . $generetKode2;

        // get data karyawan model
        $karyawan = $this->karyawanModel->findAll();

        $data = [
            'tittle' => 'Data Users',
            'kode_users' => $kode_users,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation(),
            'departemen' => $this->departemenModel->findAll()
        ];
        return view('karyawan/index', $data);
    }


    public function index2()
    {
        // get data karyawan model
        $karyawan = $this->karyawanModel->findAll();

        $data = [
            'tittle' => 'Data Users',
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation(),
            'departemen' => $this->departemenModel->findAll()
        ];
        return view('karyawan/index2', $data);
    }

    public function proses_input()
    {
        // validasi form input users
        if (!$this->validate([
            'kode_user' => [
                'rules' => 'required|is_unique[karyawan.kode_user]',
                'errors' => [
                    'required' => 'Field nama tidak boleh kosong!',
                    'is-unique' => 'Kode guest sudah terdaftar!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field nama tidak boleh kosong!'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Field nama tidak boleh kosong!',
                    'valid_email' => 'Email tidak valid!'
                ]
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field phone tidak boleh kosong!'
                ]
            ],
            'departemen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih departemen!'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih level user!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/users'))->withInput();
        } else {
            // insert data form users kedalam table guest
            $this->karyawanModel->save([
                'kode_user' => $this->request->getVar('kode_user'),
                'nama_lengkap' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'phone' => $this->request->getVar('phone'),
                'departemen' => $this->request->getVar('departemen'),
            ]);

            // generate password
            $password = "password123";
            // hashing paswword sebelum insert database
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // insert kedalam table users
            $this->userModel->save([
                'id_users' => $this->request->getVar('kode_user'),
                'username' => $this->request->getVar('email'),
                'password' => $password_hash,
                'level' => $this->request->getVar('level')
            ]);


            session()->setFlashdata('pesan', 'Data Users Berhasil di Tambah!');
            return redirect()->to(base_url('/admin/users'));
        }
    }


    public function update_user($kode_users)
    {
        // decript kode user
        $kodeUser = base64_decode($kode_users);

        // get data user kedalam table karyawan
        $data_user = $this->karyawanModel->where('kode_user', $kodeUser)->first();
        // get data departemen
        $departemen = $this->departemenModel->findAll();
        // get level user
        $level = $this->userModel->where('id_users', $kodeUser)->first();

        $data = [
            'tittle' => 'Update Data User',
            'data_user' => $data_user,
            'validation' => \Config\Services::validation(),
            'departemen' => $departemen,
            'level' => $level
        ];

        return view('karyawan/update', $data);
    }


    public function proses_update($kode_user)
    {
        // decript kode user
        $kodeUser = base64_decode($kode_user);

        // validasi form update
        if (!$this->validate([
            'kode_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode User Harus Di Lengkapi!',
                    'is_unique' => 'Kode User Sudah Terdaftar!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama User Harus Di Lengkapi!'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Nama User Harus Di Lengkapi!',
                    'valid_email' => 'Email yang anda masukan tidak valid!'
                ]
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Phone User Harus Di Lengkapi!'
                ]
            ],
            'departemen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Departemen!'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level User Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/update-user/' . $kode_user))->withInput();
        } else {
            // get id karyawan
            $id = $this->karyawanModel->where('kode_user', $kodeUser)->first();
            // get id user
            $id_user = $this->userModel->where('id_users', $kodeUser)->first();

            // update table karyawan
            $this->karyawanModel->save([
                'id' => $id['id'],
                'kode_guest' => $this->request->getVar('kode_user'),
                'nama_lengkap' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'phone' => $this->request->getVar('phone'),
                'departemen' => $this->request->getVar('departemen')
            ]);

            // get level
            $level = $this->request->getVar('level');



            // update table user
            $this->userModel->save([
                'id' => $id_user['id'],
                'username' => $this->request->getVar('email'),
                'level' => $level
            ]);

            session()->setFlashdata('pesan', 'Data User Berhasil di Update!');
            return redirect()->to(base_url('/admin/users'));
        }
    }

    public function teknisi()
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
        $kode_users = 'USR-' . $generetKode1 . $generetKode2;

        // get data karyawan model
        $karyawan = $this->userModel->where('level', 'Teknisi')->findAll();

        $data = [
            'tittle' => 'Data Teknisi',
            'kode_users' => $kode_users,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation(),
            'departemen' => $this->departemenModel->findAll()
        ];
        return view('karyawan/teknisi', $data);
    }

    public function hapus($kode_user)
    {
        // decript kode user
        $kodeUser = base64_decode($kode_user);

        // get data karyawan by kode user
        $data_karyawan = $this->karyawanModel->where('kode_user', $kodeUser)->first();
        // get data user auth by kode user
        $data_user = $this->userModel->where('id_users', $kodeUser)->first();

        // get id karyawan
        $id_karyawan = $data_karyawan['id'];
        // delete data guest
        $this->karyawanModel->delete($id_karyawan);

        // get id user
        $id_user = $data_user['id'];
        // delete data user
        $this->userModel->delete($id_user);

        // session flash data
        session()->setFlashdata('pesan', 'Data User Berhasil di Hapus!');
        return redirect()->to(base_url('/admin/users'))->withInput();
    }
}
