<?php

namespace App\Controllers;

use App\Models\Modelmahasiswa;

class Mahasiswa extends BaseController
{
    public function index()
    {
        return view('mahasiswa/viewTampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $mhs = new Modelmahasiswa;
            $data = [
                'tampildata' => $mhs->findAll()
            ];
            $msg = [
                'data' => view('mahasiswa/datamahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat di proses');
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('mahasiswa/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat di proses');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nim' => [
                    'label' => 'NIM',
                    'rules' => 'required|is_unique[mahasiswa.nim]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh ada yang sama, silahkan coba yang lain',
                    ]
                ],

                'nama' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'tmplahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'tgllahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nim' => $validation->getError('nim'),
                        'nama' => $validation->getError('nama'),
                        'tmplahir' => $validation->getError('tmplahir'),
                        'tgllahir' => $validation->getError('tgllahir'),
                        'jenkel' => $validation->getError('jenkel'),
                    ]
                ];
            } else {
                // Jika benar/valid
                $simpandata = [
                    'nim' => $this->request->getPost('nim'),
                    'nama' => $this->request->getPost('nama'),
                    'tmplahir' => $this->request->getPost('tmplahir'),
                    'tgllahir' => $this->request->getPost('tgllahir'),
                    'jenkel' => $this->request->getPost('jenkel'),
                ];

                $mhs = new Modelmahasiswa;
                $mhs->insert($simpandata);

                $msg = [
                    'sukses' => 'Data Mahasiswa berhasil di tersimpan !!!'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat di proses');
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_mahasiswa = $this->request->getVar('id_mahasiswa');

            $mhs = new Modelmahasiswa;
            $row = $mhs->find($id_mahasiswa);
            $data = [
                // sebelah kanan fild pada tabel mahasiswa
                'id_mahasiswa' => $row['id_mahasiswa'],
                'nim' => $row['nim'],
                'nama' => $row['nama'],
                'tmplahir' => $row['tmplahir'],
                'tgllahir' => $row['tgllahir'],
                'jenkel' => $row['jenkel'],
            ];
            $msg = [
                'sukses' => view('mahasiswa/modaledit', $data)
            ];

            echo json_encode($msg);
        }
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            // Jika benar/valid
            $simpandata = [
                'nim' => $this->request->getPost('nim'),
                'nama' => $this->request->getPost('nama'),
                'tmplahir' => $this->request->getPost('tmplahir'),
                'tgllahir' => $this->request->getPost('tgllahir'),
                'jenkel' => $this->request->getPost('jenkel'),
            ];

            $mhs = new Modelmahasiswa;
            $id_mahasiswa = $this->request->getVar('id_mahasiswa');
            $mhs->update($id_mahasiswa, $simpandata);

            $msg = [
                'sukses' => 'Data Mahasiswa berhasil di Update !!!'
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat di proses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_mahasiswa = $this->request->getVar('id_mahasiswa');
            $mhs = new Modelmahasiswa;

            $mhs->delete($id_mahasiswa);

            $msg = [
                'sukses' => "Mahasiswa Berhasil di Hapus !!!"
            ];
            echo json_encode($msg);
        }
    }
}
