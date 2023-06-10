<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\KaryawanModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->karyawanModel = new KaryawanModel();
    }
    public function index()
    {
        if (session()->has('nama')) {
            return redirect()->to(base_url('/views'));
        }

        $data = [
            'tittle' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/index', $data);
    }

    public function proses_login()
    {
        // select data dari table users
        $data_user = $this->authModel->findAll();
        // get data inputan dari form login
        $data_form = $this->request->getVar();

        // validasi form login
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Username Tidak Boleh Kosong!',
                    'valid_email' => 'Username Harus Berupa Email!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/'))->withInput();
        } else {
            // cek apakah username terdaftar di dalam database?
            $user = $this->authModel->where('username', $data_form['email'])->first();
            // jika username terdaftar
            if ($user) {
                // cek apakah password sesuai dengan akun yang sudah terdaftar
                if (password_verify($data_form['password'], $user['password'])) {
                    // get level yang sedang login
                    $level = $user['level'];

                    // cek apakah yang login adalah admin?
                    $data = $this->karyawanModel->where('kode_user', $user['id_users'])->first();

                    // jika yang login adalah admin
                    if ($level ==  'Admin') {
                        // siapkan session
                        $data_session = [
                            'login' => true,
                            'nama' => $data['nama_lengkap'],
                            'kode_user' => $data['kode_user'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'level' => $level
                        ];

                        session()->set($data_session);
                        return redirect()->to(base_url('/views'));
                    }
                    // jika yang login adalah Teknisi
                    if ($level ==  'Teknisi') {
                        // siapkan session
                        $data_session = [
                            'login' => true,
                            'nama' => $data['nama_lengkap'],
                            'kode_user' => $data['kode_user'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'level' => $level
                        ];

                        session()->set($data_session);
                        return redirect()->to(base_url('/views'));
                    }

                    // jika yang login adalah Respon Handler
                    if ($level ==  'Respon Handler') {
                        // siapkan session
                        $data_session = [
                            'login' => true,
                            'nama' => $data['nama_lengkap'],
                            'kode_user' => $data['kode_user'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'level' => $level
                        ];

                        session()->set($data_session);
                        return redirect()->to(base_url('/views'));
                    }
                } else {
                    session()->setFlashdata('pesan', 'Password yang anda masukan salah!');
                    return redirect()->to(base_url('/'));
                }
            } else {
                session()->setFlashdata('pesan', 'Username Tidak Terdaftar!');
                return redirect()->to(base_url('/'));
            }
        }
    }

    public function logout()
    {
        $data_session = ['login', 'nama', 'level'];
        session()->remove($data_session);
        return redirect()->to(base_url('/'));
    }

    //--------------------------------------------------------------------
    public function reset_password()
    {
        $data = [
            'tittle' => 'Reset Password',
            'validation' => \Config\Services::validation()
        ];

        return view('Auth/reset', $data);
    }

    public function proses_reset()
    {
        $data_email = $this->request->getVar('email');

        $data = [
            'tittle' => 'Reset Password',
            'validation' => \Config\Services::validation(),
            'data_email' => $this->request->getVar('email')
        ];

        // get data email dari table user
        $data_user = $this->authModel->where('username', $data_email)->first();

        if ($data_user) {
            return view('Auth/reset_password', $data);
        } else {
            session()->setFlashdata('pesan', 'Email yang anda masukan tidak terdaftar!');
            return redirect()->to(base_url('/reset-password'))->withInput();
        }
    }

    public function proses_reset_password()
    {
        $password_baru = $this->request->getVar('password_baru');
        $konfirmasi_password = $this->request->getVar('konfirmasi_password');
        $email = $this->request->getVar('email');

        if ($password_baru == $konfirmasi_password) {
            // update password didalam table auth
            $data = $this->authModel->where('username', $email)->first();
            $id = $data['id'];

            // set password baru
            // generate password
            $password = $konfirmasi_password;
            // hashing paswword sebelum insert database
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $this->authModel->save([
                'id' => $id,
                'password' => $password_hash
            ]);

            session()->setFlashdata('pesan-success', 'Reset Password berhasil silahkan login');
            return redirect()->to(base_url('/'))->withInput();
        } else {
            session()->setFlashdata('pesan', 'Konfirmasi Password tidak sesuai!');
            return redirect()->to(base_url('/reset-password'))->withInput();
        }
    }

    public function update_password()
    {
        $data = [
            'tittle' => 'Upate Password',
            'validation' => \Config\Services::validation()
        ];

        return view('Auth/update_password', $data);
    }


    public function proses_update_password()
    {
        // validasi form update password
        if (!$this->validate([
            'password_lama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Lama Tidak Boleh Kosong!',
                ]
            ],
            'password_baru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Baru Tidak Boleh Kosong!'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required',
                'errores' => [
                    'required' => 'Password Konfirmasi Tidak Boleh Kosong!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/views/update-password'))->withInput();
        } else {
            // cek password lama
            $password_lama = $this->request->getVar('password_lama');
            $password_baru = $this->request->getVar('password_baru');
            $konfirmasi_password = $this->request->getVar('konfirmasi_password');
            // get session email
            $email = session('email');
            // get data user dari table user by email user yang sedang login
            $data_user = $this->authModel->where('username', $email)->first();

            if ($data_user) {
                // get password lama dari table user
                if (password_verify($password_lama, $data_user['password'])) {
                    // cek apakah password baru dan konfirmasi password sama? 
                    if ($password_baru != $konfirmasi_password) {
                        session()->setFlashdata('pesan', 'Konfirmasi Password tidak sesuai!');
                        return redirect()->to(base_url('/views/update-password'))->withInput();
                    } else {
                        // update password yang ada didalam table users
                        // get id data user yang sedang login
                        $id = $data_user['id'];

                        // hashing paswword sebelum update database
                        $password_hash = password_hash($konfirmasi_password, PASSWORD_DEFAULT);
                        // update password
                        $this->authModel->save([
                            'id' => $id,
                            'password' => $password_hash
                        ]);
                        session()->setFlashdata('pesan-success', 'Password anda berhasil dirubah!');
                        return redirect()->to(base_url('/views/update-password'))->withInput();
                    }
                } else {
                    session()->setFlashdata('pesan', 'Password lama anda tidak sesuai!');
                    return redirect()->to(base_url('/views/update-password'))->withInput();
                }
            }
        }
    }
}
