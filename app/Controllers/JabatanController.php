<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JabatanModel;

class JabatanController extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
    }
    public function index()
    {
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
        $session = session();
        $allowedLevels = ['admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $data = [
            'title' => 'Data Jabatan',
            'jabatan' => $this->jabatanModel->findAll()
        ];
        return view('jabatan/index', $data);
    }

    public function proses_jabatan()
    {
        // validasi input data dari form setiap atribut
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_jabatan' => 'required|is_unique[tb_jabatan.nama_jabatan]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_jabatan')->withInput()->with('validation', $validation);
        }

        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
        ];

        $this->jabatanModel->insert($data);
        return redirect()->to('/kelola_jabatan')->with('success', 'Data berhasil ditambahkan');
    }

    public function update_jabatan()
    {
        $id_jabatan = $this->request->getPost('id_jabatan');
        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
        ];
        $this->jabatanModel->where('id_jabatan', $id_jabatan)->set($data)->update();
        return redirect()->to('/kelola_jabatan')->with('success', 'Data berhasil diubah');
    }

    public function hapus_jabatan($id)
    {
        $this->jabatanModel->delete($id);
        return redirect()->to('/kelola_jabatan')->with('success', 'Data berhasil dihapus');
    }
}
