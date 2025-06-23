<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KontakModel;

class KontakController extends BaseController
{

    protected $kontakModel;

    public function __construct()
    {
        $this->kontakModel = new KontakModel();
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
    }

    public function index()
    {

        $session = session();
        $allowedLevels = ['admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'title' => 'Kelola Kontak',
            'kontak' => $this->kontakModel->findAll()
        ];

        return view('konten/kontak', $data);
    }

    public function update_kontak()
    {
        $id_kontak = $this->request->getPost('id_kontak');
        $data = [
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
            'lokasi' => $this->request->getPost('lokasi')
        ];

        $this->kontakModel->update($id_kontak, $data);
        return redirect()->to('/kelola_kontak')->with('success', 'Data Berhasil dirubah');
    }
}
