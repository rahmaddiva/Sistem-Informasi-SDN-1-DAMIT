<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\GuruModel;
use App\Models\JabatanModel;
use App\Models\MapelModel;

class GuruController extends BaseController
{

    protected $guruModel;

    protected $jabatanModel;

    protected $mapelModel;

    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->jabatanModel = new JabatanModel();
        $this->mapelModel = new MapelModel();
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
        $allowedLevels = ['wali_kelas', 'guru', 'admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $data = [
            'title' => 'Data Guru',
            'guru' => $this->guruModel->getGuru(),
            'jabatan' => $this->jabatanModel->findAll(),
            'mapel' => $this->mapelModel->findAll(),
        ];
        return view('guru/index', $data);
    }

    public function proses_guru()
    {
        // Validasi input data dari form setiap atribut
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nip' => 'required|is_unique[tb_guru.nip]',
            'nama' => 'required',

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_guru')->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');

        // Memastikan file foto valid dan telah diunggah
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $namaFoto = $foto->getRandomName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_guru', $namaFoto);
        } else {
            $namaFoto = 'default_person.jpg'; // Nama file default yang disimpan di folder 'foto_siswa'
            copy(FCPATH . 'landingpage/assets/img/team/team-2.jpg   ', FCPATH . 'foto_guru/' . $namaFoto);
        }

        $data = [
            'nip' => $this->request->getPost('nip'),
            'nama' => $this->request->getPost('nama'),
            'id_jabatan' => $this->request->getPost('id_jabatan'),
            'foto' => $namaFoto,
            // 'id_pengguna' => session()->get('id_user'),
        ];

        $this->guruModel->insert($data);
        return redirect()->to('/kelola_guru')->with('success', 'Data berhasil ditambahkan');
    }

    public function update_guru()
    {
        $id_guru = $this->request->getPost('id_guru');
        $foto = $this->request->getFile('foto');
        $data = [
            'nip' => $this->request->getPost('nip'),
            'nama' => $this->request->getPost('nama'),
            'id_jabatan' => $this->request->getPost('id_jabatan'),

        ];

        // jika gambar diunggah dan valid
        if ($foto->isValid() && !$foto->hasMoved()) {
            // pindahkan gambar ke direktori yang diinginkan
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'foto_guru', $newName)) {
                $data['foto'] = $newName;

                // hapus foto lama jika ada
                $foto_lama = $this->request->getPost('foto_lama');
                $path = FCPATH . 'foto_guru' . $foto_lama;
                if ($foto_lama && file_exists($path)) {
                    if (!unlink($path)) {
                        return redirect()->to('/kelola_guru')->with('error', 'Gagal menghapus foto lama');
                    }
                }
            } else {
                return redirect()->to('/kelola_guru')->with('error', 'Gagal mengunggah foto');
            }
        } else {
            $data['foto'] = $this->request->getPost('foto_lama');
        }
        $this->guruModel->where('id_guru', $id_guru)->set($data)->update();
        return redirect()->to('/kelola_guru')->with('success', 'Data berhasil diubah');
    }

    public function hapus_guru($id)
    {
        $foto = $this->guruModel->find($id)['foto'];
        $path = FCPATH . 'foto_guru' . $foto;
        if ($foto && file_exists($path)) {
            if (!unlink($path)) {
                return redirect()->to('/kelola_guru')->with('error', 'Gagal menghapus foto');
            }
        }
        $this->guruModel->delete($id);
        return redirect()->to('/kelola_guru')->with('success', 'Data berhasil dihapus');
    }
}
