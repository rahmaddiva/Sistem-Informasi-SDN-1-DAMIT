<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WilayahModel;
use CodeIgniter\HTTP\ResponseInterface;

class WilayahController extends BaseController
{

    protected $wilayahModel;

    public function __construct()
    {
        $this->wilayahModel = new WilayahModel();
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
            'title' => 'Data Wilayah',
            'wilayah' => $this->wilayahModel->findAll()
        ];

        return view('wilayah/index', $data);
    }

    public function wilayah()
    {
        $data = [
            'title' => 'Data Wilayah',
            'wilayah' => $this->wilayahModel->findAll()
        ];

        return view('konten/wilayah', $data);
    }

    public function update_wilayah()
    {
        $id_wilayah = $this->request->getPost('id_wilayah');
        $data = [
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        $this->wilayahModel->update($id_wilayah, $data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('/kelola_wilayah');
    }
}
