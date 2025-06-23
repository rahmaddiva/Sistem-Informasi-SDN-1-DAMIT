<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TentangModel;

class TentangController extends BaseController
{

    protected $tentangModel;

    public function __construct()
    {
        $this->tentangModel = new TentangModel();
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
            'title' => 'Kelola Tentang',
            'tentang' => $this->tentangModel->findAll()
        ];

        return view('konten/tentang', $data);
    }

    public function update_tentang()
    {
        // Validasi input data dari form setiap atribut
        $id_tentang = $this->request->getPost('id_tentang');

        $data = [
            'tentang' => $this->request->getPost('tentang'),
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi')
        ];

        $this->tentangModel->where('id_tentang', $id_tentang)->set($data)->update();
        return redirect()->to('/kelola_tentang')->with('success', 'Data berhasil diperbarui');
    }
}
