<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KegiatanModel;

class KegiatanController extends BaseController
{

    protected $KegiatanModel;

    public function __construct()
    {
        $this->KegiatanModel = new KegiatanModel();
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
            'title' => 'Kelola Kegiatan',
            'kegiatan' => $this->KegiatanModel->findAll()
        ];

        return view('konten/kegiatan', $data);
    }

    public function detail_kegiatan($judul)
    {
        $model = new KegiatanModel();
        $kegiatan = $model->where('judul', urldecode($judul))->first();

        if ($kegiatan) {
            $data['kegiatan'] = $kegiatan;
            $data['title'] = 'Detail Kegiatan';
            $data['other_kegiatan'] = $model->where('judul !=', urldecode($judul))->findAll();
            return view('konten/detail_kegiatan', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function proses_kegiatan()
    {
        // validasi input dari form di setiap atribut
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_kegiatan')->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');

        // Memastikan file foto valid dan telah diunggah
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $namaFoto = $foto->getRandomName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_kegiatan', $namaFoto);
        } else {
            // upload foto default
            $namaFoto = 'default.jpg';
            copy(FCPATH . 'landingpage/images/img_7.jpg', FCPATH . 'foto_kegiatan/' . $namaFoto);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tanggal' => date('Y-m-d'),
            'foto' => $namaFoto
        ];
        $this->KegiatanModel->insert($data);
        return redirect()->to('/kelola_kegiatan')->with('success', 'Data kegiatan berhasil ditambahkan');
    }

    public function update_kegiatan()
    {
        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $foto = $this->request->getFile('foto');
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tanggal' => date('Y-m-d'),
        ];
        if ($foto->isValid() && !$foto->hasMoved()) {
            // pindahkan gambar ke direktori yang diinginkan
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'foto_kegiatan', $newName)) {
                $data['foto'] = $newName;

                // hapus foto lama jika ada
                $foto_lama = $this->request->getPost('foto_lama');
                $path = FCPATH . 'foto_kegiatan' . $foto_lama;
                if ($foto_lama && file_exists($path)) {
                    if (!unlink($path)) {
                        return redirect()->to('/kelola_kegiatan')->with('error', 'Gagal menghapus foto lama');
                    }
                }
            } else {
                return redirect()->to('/kelola_kegiatan')->with('error', 'Gagal mengunggah foto');
            }
        } else {
            $data['foto'] = $this->request->getPost('foto_lama');
        }
        $this->KegiatanModel->where('id_kegiatan', $id_kegiatan)->set($data)->update();
        return redirect()->to('/kelola_kegiatan')->with('success', 'Data kegiatan berhasil diubah');
    }

    public function hapus_kegiatan($id_kegiatan)
    {
        $kegiatan = $this->KegiatanModel->find($id_kegiatan);
        $path = FCPATH . 'foto_kegiatan/' . $kegiatan['foto'];
        if (file_exists($path)) {
            if (!unlink($path)) {
                return redirect()->to('/kelola_kegiatan')->with('error', 'Gagal menghapus foto');
            }
        }
        $this->KegiatanModel->delete($id_kegiatan);
        return redirect()->to('/kelola_kegiatan')->with('success', 'Data kegiatan berhasil dihapus');
    }

}
