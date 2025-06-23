<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FasilitasModel;

class FasilitasController extends BaseController
{

    protected $fasilitasModel;

    public function __construct()
    {
        $this->fasilitasModel = new FasilitasModel();
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
        $data = [
            'title' => 'Fasilitas',
            'fasilitas' => $this->fasilitasModel->findAll()
        ];

        return view('fasilitas/index', $data);
    }

    public function fasilitas()
    {
        $data = [
            'title' => 'Fasilitas',
            'fasilitas' => $this->fasilitasModel->findAll()
        ];

        return view('konten/fasilitas', $data);
    }

    public function proses_fasilitas()
    {
        // Validasi input data dari form setiap atribut
        $validation = \Config\Services::validation();
        $validation->setRules([
            'keterangan' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,3065]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_fasilitas')->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');

        // Memastikan file foto valid dan telah diunggah
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $namaFoto = $foto->getRandomName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_fasilitas', $namaFoto);
        } else {
            return redirect()->to('/kelola_fasilitas')->withInput()->with('errors', ['Foto tidak valid']);
        }
        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'foto' => $namaFoto
        ];
        $this->fasilitasModel->insert($data);
        return redirect()->to('/kelola_fasilitas')->with('success', 'Data fasilitas berhasil ditambahkan');
    }

    public function update_fasilitas()
    {
        $id_fasilitas = $this->request->getPost('id_fasilitas');
        $foto = $this->request->getFile('foto');

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        // jika gambar diunggah dan valid
        if ($foto->isValid() && !$foto->hasMoved()) {
            // pindahkan gambar ke direktori yang diinginkan
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'foto_fasilitas', $newName)) {
                $data['foto'] = $newName;

                // hapus foto lama jika ada
                $foto_lama = $this->request->getPost('foto_lama');
                $path = FCPATH . 'foto_fasilitas' . $foto_lama;
                if ($foto_lama && file_exists($path)) {
                    if (!unlink($path)) {
                        return redirect()->to('/kelola_fasilitas')->with('error', 'Gagal menghapus foto lama');
                    }
                }
            } else {
                return redirect()->to('/kelola_fasilitas')->with('error', 'Gagal mengunggah foto');
            }
        } else {
            $data['foto'] = $this->request->getPost('foto_lama');
        }
        $this->fasilitasModel->where('id_fasilitas', $id_fasilitas)->set($data)->update();
        return redirect()->to('/kelola_fasilitas')->with('success', 'Data berhasil diubah');
    }

    public function hapus_fasilitas($id)
    {
        $fasilitas = $this->fasilitasModel->find($id);
        $path = FCPATH . 'foto_fasilitas' . $fasilitas['foto'];
        if (file_exists($path)) {
            if (!unlink($path)) {
                return redirect()->to('/kelola_fasilitas')->with('error', 'Gagal menghapus foto');
            }
        }
        $this->fasilitasModel->delete($id);
        return redirect()->to('/kelola_fasilitas')->with('success', 'Data berhasil dihapus');
    }
}
