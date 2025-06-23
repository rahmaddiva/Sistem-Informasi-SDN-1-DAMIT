<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KelasModel;

class KelasController extends BaseController
{

    protected $kelasModel;

    public function __construct()
    {
        $this->kelasModel = new KelasModel();
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
            'title' => 'Data Kelas',
            'kelas' => $this->kelasModel->findAll()
        ];
        return view('kelas/index', $data);
    }

    public function proses_kelas()
    {
        // validasi input data dari form setiap atribut
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kelas' => 'required|is_unique[tb_kelas.nama_kelas]',

        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_kelas')->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');

        // Jika ada file foto yang diunggah dan file foto valid
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $data['foto'] = $foto->getName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_kelas', $foto->getName());
        } else {
            // upload foto default dari folder landingpage/images/person_3.jpg
            $namaFoto = 'default_person.jpg'; // Nama file default yang disimpan di folder 'foto_siswa'
            copy(FCPATH . 'landingpage/images/img-school-2-min', FCPATH . 'foto_kelas/' . $namaFoto);
        }

        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'foto' => $foto->getName(),
        ];

        $this->kelasModel->save($data);
        return redirect()->to('/kelola_kelas')->with('success', 'Data berhasil ditambahkan');
    }

    public function update_kelas()
    {
        $id_kelas = $this->request->getPost('id_kelas');
        $foto = $this->request->getFile('foto');
        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ];

        // jika gambar diunggah dan valid
        if ($foto->isValid() && !$foto->hasMoved()) {
            // pindahkan gambar ke direktori yang diinginkan
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'foto_kelas', $newName)) {
                $data['foto'] = $newName;

                // hapus foto lama jika ada
                $foto_lama = $this->request->getPost('foto_lama');
                $path = FCPATH . 'foto_kelas' . $foto_lama;
                if ($foto_lama && file_exists($path)) {
                    if (!unlink($path)) {
                        return redirect()->to('/kelola_kelas')->with('error', 'Gagal menghapus foto lama');
                    }
                }
            } else {
                return redirect()->to('/kelola_kelas')->with('error', 'Gagal mengunggah foto');
            }
        } else {
            $data['foto'] = $this->request->getPost('foto_lama');
        }
        $this->kelasModel->where('id_kelas', $id_kelas)->set($data)->update();
        return redirect()->to('/kelola_kelas')->with('success', 'Data berhasil diubah');
    }

    public function hapus_kelas($id)
    {
        $foto = $this->kelasModel->find($id)['foto'];
        $path = FCPATH . 'foto_kelas' . $foto;
        if ($foto && file_exists($path)) {
            if (!unlink($path)) {
                return redirect()->to('/kelola_kelas')->with('error', 'Gagal menghapus foto');
            } else {
                $this->kelasModel->delete($id);
                return redirect()->to('/kelola_kelas')->with('success', 'Data berhasil dihapus');
            }
        }
        $this->kelasModel->delete($id);
        return redirect()->to('/kelola_kelas')->with('success', 'Data berhasil dihapus');
    }
}
