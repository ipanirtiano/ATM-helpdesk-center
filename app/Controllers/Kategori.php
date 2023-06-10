<?php

namespace App\Controllers;

use App\Models\DepartemenModel;
use App\Models\KategoriModel;

class Kategori extends BaseController
{

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        //generet kode kategori random 3 digit pertama
        $angka_kode1 = range(0, 9);
        shuffle($angka_kode1);
        $ambilKode1 = array_rand($angka_kode1, 3);
        $generetKode1 = implode('', $ambilKode1);
        // generate kode kategori random 3 digit kedua
        $angka_kode2 = range(0, 9);
        shuffle($angka_kode2);
        $ambilKode2 = array_rand($angka_kode2, 3);
        $generetKode2 = implode('', $ambilKode2);
        // kode kategori yang sudah di random
        $kode_kategori = 'K-' . $generetKode1 . $generetKode2;

        // select table katogori
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'tittle' => 'Kategori',
            'kode_kategori' => $kode_kategori,
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori
        ];
        return view('kategori/index', $data);
    }

    public function proses_input()
    {
        // validasi form input departemen
        if (!$this->validate([
            'kode_kategori' => [
                'rules' => 'required|is_unique[kategori.kode_kategori]',
                'errors' => [
                    'required' => 'Kode Kategori Harus Di Lengkapi!',
                    'is_unique' => 'Kode Kategori Sudah Terdaftar!'
                ]
            ],
            'nama_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kategori Harus Di Lengkapi!'
                ]
            ],
        ])) {

            return redirect()->to(base_url('/admin/kategori'))->withInput();
        } else {
            // insert data kedalam table departemen
            $this->kategoriModel->save([
                'kode_kategori' => $this->request->getVar('kode_kategori'),
                'nama_kategori' => $this->request->getVar('nama_kategori')
            ]);


            session()->setFlashdata('pesan', 'Data Kategori Berhasil di Tambah!');
            return redirect()->to(base_url('/admin/kategori'));
        }
    }

    public function update_kat($kode_dept)
    {
        // data kode dept yang di decrypt
        $kode_departemen = base64_decode($kode_dept);
        // select kedalam table departemen
        $data_dept = $this->kategoriModel->where('kode_kategori', $kode_departemen)->first();


        $data = [
            'tittle' => 'Edit Kategori',
            'departemen_upd' => $data_dept,
            'validation' => \Config\Services::validation(),
        ];

        return view('Kategori/update', $data);
    }

    public function proses_update($kode_dept)
    {
        // get kode_dept encript
        $kodeDept = base64_decode($kode_dept);
        // validasi form update
        if (!$this->validate([
            'kode_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Kategori Harus Di Lengkapi!'
                ]
            ],
            'nama_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kategori Harus Di Lengkapi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/update-kategori/' . $kode_dept));
        } else {
            // get id dari data table departemen
            $id = $this->kategoriModel->where('kode_kategori', $kodeDept)->first();

            // update data table departement
            $this->kategoriModel->save([
                'id' => $id['id'],
                'kode_kategori' => $this->request->getVar('kode_kategori'),
                'nama_kategori' => $this->request->getVar('nama_kategori')
            ]);
            session()->setFlashdata('pesan', 'Data Kategori Berhasil di Update!');
            return redirect()->to(base_url('/admin/kategori'))->withInput();
        }
    }

    public function hapus($kode_dept)
    {
        // enkripsi kode departemen
        $kodeDept = base64_decode($kode_dept);

        // get data departemen by kode departemen
        $data_dept = $this->kategoriModel->where('kode_kategori', $kodeDept)->first();
        // hapus data departemen dari table departemen
        $id_dept = $data_dept['id'];
        $this->kategoriModel->delete($id_dept);

        session()->setFlashdata('pesan', 'Data Kategori Berhasil di Hapus!');
        return redirect()->to(base_url('/admin/kategori'))->withInput();
    }
}
