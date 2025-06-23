<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FotoModel;

class FotoController extends BaseController
{

    protected $fotoModel;

    public function __construct()
    {
        $this->fotoModel = new FotoModel();
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
        $data = [
            'title' => 'Kelola Foto',
            'foto' => $this->fotoModel->findAll()
        ];
        return view('konten/foto', $data);
    }

    public function proses_foto()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|max_size[foto,3057]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $namaFoto = $foto->getRandomName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_foto', $namaFoto);
        } else {
            $namaFoto = 'default_person.jpg'; // Nama file default yang disimpan di folder 'foto_siswa'
            copy(FCPATH . 'landingpage/images/img-2', FCPATH . 'foto_foto/' . $namaFoto);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => date('Y-m-d H:i:s'), // Tambahkan atribut 'tanggal' dengan nilai tanggal saat ini
            'foto' => $namaFoto,
        ];

        $this->fotoModel->insert($data);

        return redirect()->to('/kelola_foto')->with('success', 'Foto berhasil diupload');
    }

    public function update_foto($id_foto)
    {
        $fotoModel = new FotoModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'max_size[foto,3057]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $fotoFile = $this->request->getFile('foto');
        $currentFoto = $fotoModel->find($id_foto)['foto'];

        $data = [
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Memastikan file foto valid dan telah diunggah
        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            // Hapus foto lama jika ada
            if (file_exists(FCPATH . 'foto_foto' . $currentFoto)) {
                unlink(FCPATH . 'foto_foto' . $currentFoto);
            }

            // Simpan foto baru
            $namaFoto = $fotoFile->getRandomName();
            $fotoFile->move(FCPATH . 'foto_foto', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $fotoModel->update($id_foto, $data);
        return redirect()->to('/kelola_foto')->with('success', 'Foto berhasil diperbarui');
    }

    public function hapus_foto($id_foto)
    {
        $fotoModel = new FotoModel();
        $foto = $fotoModel->find($id_foto);

        if ($foto) {
            if (file_exists(FCPATH . 'foto_foto' . $foto['foto'])) {
                unlink(FCPATH . 'foto_foto' . $foto['foto']);
            }

            $fotoModel->delete($id_foto);
            return redirect()->to('/kelola_foto')->with('success', 'Foto berhasil dihapus');
        }

        return redirect()->to('/kelola_foto')->with('error', 'Foto tidak ditemukan');
    }
}
