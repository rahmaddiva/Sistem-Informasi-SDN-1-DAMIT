<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AuthModel;

class AuthController extends BaseController
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        // jika session tidak ada maka akan dialihkan ke halaman login

    }

    public function kelola_akun()
    {

        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }

        $data = [
            'title' => 'Kelola Akun',
            'user' => $this->authModel->findAll(),
        ];

        return view('auth/kelola_akun', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth/login', $data);
    }

    public function logout()
    {
        // hapus semua session
        session()->destroy();
        return redirect()->to('/login');
    }

    public function proses_login()
    {
        // validasi input dari form login 
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
        ]);
        // jika input data tidak sesuai dengan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/login')->withInput()->with('validation', $validation);
        }
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ];
        $user = $this->authModel->where('username', $data['username'])->first();
        // jika data user tidak ditemukan
        if (!$user) {
            return redirect()->to('/login')->withInput()->with('error', 'Username tidak ditemukan');
        }
        // jika password tidak sesuai dengan password yang ada di database
        if (!password_verify($data['password'], $user['password'])) {
            return redirect()->to('/login')->withInput()->with('error', 'Password salah');
        }

        // jika data user ditemukan maka akan disimpan pada session
        $session = session();
        $session->set([
            'id_user' => $user['id_user'],
            'id_guru' => $user['id_guru'],
            'username' => $user['username'],
            'nama' => $user['nama'],
            'level' => $user['level'],
        ]);
        return redirect()->to('/dashboard');
    }

    public function proses_akun()
    {
        // validasi input data dari form setiap atribut 
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required|is_unique[tb_user.username]',
            'password' => 'required|min_length[6]',
            'level' => 'required',
        ]);
        // jika input data tidak sesuai dengan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_akun')->withInput()->with('validation', $validation);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level'),
        ];

        $this->authModel->insert($data);

        return redirect()->to('kelola_akun')->with('success', 'Data berhasil ditambahkan');
    }

    public function update_akun()
    {
        $id_user = $this->request->getPost('id_user');
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level = $this->request->getPost('level');

        // Siapkan array data yang akan diupdate
        $data = [
            'nama' => $nama,
            'username' => $username,
            'level' => $level,
        ];


        // Jika password baru diisi, hash dan update password baru
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $data['password'] = $hashedPassword;
        }

        // Update data ke database
        $this->authModel->update($id_user, $data);

        return redirect()->to('kelola_akun')->with('success', 'Data berhasil diubah');
    }



    public function hapus($id)
    {
        // lakukan pengecekan jika hanya ada satu data user maka tidak bisa dihapus
        if ($this->authModel->countAllResults() == 1) {
            return redirect()->to('kelola_akun')->with('error', 'Data tidak bisa dihapus, Karena hanya ada satu data user');
        }
        $this->authModel->delete($id);
        return redirect()->to('kelola_akun')->with('success', 'Data Berhasil Dihapus');
    }



}
