<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\GuruModel;


class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;

    protected $guruModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
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
            'title' => 'Data Siswa',
            'siswa' => $this->siswaModel->getSiswa(),
            'kelas' => $this->kelasModel->findAll(),
            'guru' => $this->guruModel->getGuru(),
        ];
        return view('siswa/index', $data);
    }

    public function siswaByKelas($id_kelas)
    {
        $data = [
            'title' => 'Data Siswa Berdasarkan Kelas',
            'siswa' => $this->siswaModel->getSiswaByKelas($id_kelas), // Mengambil data siswa berdasarkan kelas dari model
        ];

        return view('konten/siswabykelas', $data); // Mengirim data ke view
    }
    public function kelas()
    {
        $data = [
            'title' => 'Data Kelas',
            'kelas' => $this->kelasModel->findAll(),
        ];
        return view('konten/kelas', $data);
    }

    // function tampil siswa berdasarkan kelas


    public function proses_siswa()
    {
        // validasi input dari form di setiap atribut
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nisn' => 'required|is_unique[tb_siswa.nisn]',
            'nama' => 'required',
            'id_kelas' => 'required',
            'id_guru' => 'required',
            'jenis_kelamin' => 'required',

        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kelola_siswa')->withInput()->with('validation', $validation);
        }

        $foto = $this->request->getFile('foto');

        // Memastikan file foto valid dan telah diunggah
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Simpan nama file foto ke dalam array data
            $namaFoto = $foto->getRandomName();
            // Pindahkan file foto ke direktori yang diinginkan
            $foto->move(FCPATH . 'foto_siswa', $namaFoto);
        } else {
            // upload foto default dari folder landingpage/images/person_3.jpg
            $namaFoto = 'default_person.jpg'; // Nama file default yang disimpan di folder 'foto_siswa'
            copy(FCPATH . 'landingpage/images/person_3.jpg', FCPATH . 'foto_siswa/' . $namaFoto);
        }

        $data = [
            'id_user' => session()->get('id_user'),
            'id_guru' => $this->request->getPost('id_guru'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nisn' => $this->request->getPost('nisn'),
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'foto' => $namaFoto,
        ];

        $this->siswaModel->insert($data);
        return redirect()->to('/kelola_siswa')->with('success', 'Data Berhasil ditambahkan');
    }

    public function update_siswa()
    {
        $id_siswa = $this->request->getPost('id_siswa');
        $foto = $this->request->getFile('foto');
        $data = [
            'id_guru' => $this->request->getPost('id_guru'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nisn' => $this->request->getPost('nisn'),
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ];

        if ($foto->isValid() && !$foto->hasMoved()) {
            // pindahkan gambar ke direktori yang diinginkan
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'foto_siswa', $newName)) {
                $data['foto'] = $newName;

                // hapus foto lama jika ada
                $foto_lama = $this->request->getPost('foto_lama');
                $path = FCPATH . 'foto_siswa' . $foto_lama;
                if ($foto_lama && file_exists($path)) {
                    if (!unlink($path)) {
                        return redirect()->to('/kelola_siswa')->with('error', 'Gagal menghapus foto lama');
                    }
                }
            } else {
                return redirect()->to('/kelola_siswa')->with('error', 'Gagal mengunggah foto');
            }
        } else {
            $data['foto'] = $this->request->getPost('foto_lama');
        }
        $this->siswaModel->where('id_siswa', $id_siswa)->set($data)->update();
        return redirect()->to('/kelola_siswa')->with('success', 'Data berhasil diubah');
    }

    public function hapus_siswa($id)
    {
        $foto = $this->siswaModel->find($id)['foto'];
        $path = FCPATH . '/foto_siswa' . $foto;
        if ($foto && file_exists($path)) {
            if (!unlink($path)) {
                return redirect()->to('/kelola_siswa')->with('error', 'Gagal menghapus foto');
            }
        }
        $this->siswaModel->delete($id);
        return redirect()->to('/kelola_siswa')->with('success', 'Data berhasil dihapus');
    }

}
