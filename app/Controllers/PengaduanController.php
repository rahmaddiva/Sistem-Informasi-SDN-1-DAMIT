<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PengaduanModel;

class PengaduanController extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }
    public function index()
    {
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'title' => 'Pengaduan',
            'pengaduan' => $this->pengaduanModel->findAll()
        ];
        return view('konten/pengaduan', $data);
    }

    public function proses_pengaduan()
    {
        $nama = $this->request->getPost('nama');
        $no_telp = $this->request->getPost('no_telp');
        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $tgl_pengaduan = date('Y-m-d H:i:s');
        $data = [
            'nama' => $nama,
            'no_telp' => $no_telp,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'tgl_pengaduan' => $tgl_pengaduan
        ];
        $this->pengaduanModel->insert($data);
        return redirect()->to('/')->with('success', 'Pengaduan berhasil dikirim');
    }

    public function hapus_pengaduan($id)
    {
        $this->pengaduanModel->delete($id);
        return redirect()->to('/pengaduan')->with('success', 'Pengaduan berhasil dihapus');
    }
}
