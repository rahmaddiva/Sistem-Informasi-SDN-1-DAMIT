<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfilModel;



class ProfilController extends BaseController
{

    protected $ProfilModel;

    public function __construct()
    {
        $this->ProfilModel = new ProfilModel();
    }

    public function index()
    {
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'title' => 'Kelola Profil',
            'profil' => $this->ProfilModel->findAll()
        ];

        return view('konten/profil', $data);
    }

    public function profil_sekolah()
    {
        $data = [
            'title' => 'Profil Sekolah',
            'profil' => $this->ProfilModel->findAll()
        ];

        return view('konten/profil_sekolah', $data);
    }

    public function update_profil()
    {
        $id_profil = $this->request->getPost('id_profil');
        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'akreditasi' => $this->request->getPost('akreditasi'),
            'npsn' => $this->request->getPost('npsn'),
            'nss' => $this->request->getPost('nss'),
            'bentuk_pendidikan' => $this->request->getPost('bentuk_pendidikan'),
            'status' => $this->request->getPost('status'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kelurahan' => $this->request->getPost('kelurahan'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->ProfilModel->update($id_profil, $data);
        return redirect()->to('/kelola_profil')->with('success', 'Profil berhasil diperbarui');
    }

}
