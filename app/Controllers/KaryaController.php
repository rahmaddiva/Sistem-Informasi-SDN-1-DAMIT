<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryaModel;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class KaryaController extends BaseController
{
    protected $karyaModel;

    protected $siswaModel;

    protected $guruModel;

    public function __construct()
    {
        $this->karyaModel = new KaryaModel();
        $this->siswaModel = new SiswaModel();
        $this->guruModel = new GuruModel();
    }

    public function index()
    {
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'title' => 'Data Karya',
            'karya' => $this->karyaModel->getKarya(),
            'siswa' => $this->siswaModel->getSiswa(),
            'guru' => $this->guruModel->findAll()
        ];

        return view('karya/index', $data);

    }

    public function karya()
    {
        $data = [
            'title' => 'Data Karya',
            'karya' => $this->karyaModel->getKarya(),
            'siswa' => $this->siswaModel->getSiswa(),
            'guru' => $this->guruModel->findAll()
        ];

        return view('konten/karya', $data);
    }

    public function proses_karya()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([

            'nama_karya' => 'required',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ]);
        $validation->setRules([

            'nama_karya' => 'required',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/karya')->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');

        // Memastikan file foto valid dan telah diunggah
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $namaFoto = $foto->getRandomName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_karya', $namaFoto);
        } else {
            // upload foto default
            $namaFoto = 'default.jpg';
            copy(FCPATH . 'landingpage/images/img_7.jpg', FCPATH . 'foto_karya/' . $namaFoto);
        }

        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_guru' => $this->request->getPost('id_guru'),
            'nama_karya' => $this->request->getPost('nama_karya'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $namaFoto
        ];

        $this->karyaModel->insert($data);
        return redirect()->to('/kelola_karya')->with('success', 'Data karya berhasil ditambahkan');
    }

    public function update_karya()
    {
        $id_karya = $this->request->getPost('id_karya');
        $foto = $this->request->getFile('foto');
        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_guru' => $this->request->getPost('id_guru'),
            'nama_karya' => $this->request->getPost('nama_karya'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];
        if ($foto->isValid() && !$foto->hasMoved()) {
            // pindahkan gambar ke direktori yang diinginkan
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'foto_karya', $newName)) {
                $data['foto'] = $newName;

                // hapus foto lama jika ada
                $foto_lama = $this->request->getPost('foto_lama');
                $path = FCPATH . 'foto_karya' . $foto_lama;
                if ($foto_lama && file_exists($path)) {
                    if (!unlink($path)) {
                        return redirect()->to('/kelola_karya')->with('error', 'Gagal menghapus foto lama');
                    }
                }
            } else {
                return redirect()->to('/kelola_karya')->with('error', 'Gagal mengunggah foto');
            }
        }
        $this->karyaModel->update($id_karya, $data);
        return redirect()->to('/kelola_karya')->with('success', 'Data karya berhasil diubah');
    }

    public function hapus_karya($id_karya)
    {
        $karya = $this->karyaModel->find($id_karya);
        $path = FCPATH . 'foto_karya' . $karya['foto'];
        if ($karya['foto'] && file_exists($path)) {
            if (!unlink($path)) {
                return redirect()->to('/kelola_karya')->with('error', 'Gagal menghapus foto');
            }
        }
        $this->karyaModel->delete($id_karya);
        return redirect()->to('/kelola_karya')->with('success', 'Data karya berhasil dihapus');
    }
}
