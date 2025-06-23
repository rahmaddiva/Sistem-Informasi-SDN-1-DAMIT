<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\SemesterModel;
use App\Models\AuthModel;
use App\Models\NilaiModel;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $authModel;
    protected $guruModel;
    protected $nilaiModel;
    protected $semesterModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->guruModel = new GuruModel();
        $this->authModel = new AuthModel();
        $this->nilaiModel = new NilaiModel();
        $this->semesterModel = new SemesterModel();
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
            'title' => 'Data Siswa',
            'siswa' => $this->siswaModel->getSiswa(),
            'kelas' => $this->kelasModel->findAll(),
            'guru' => $this->guruModel->getGuru(),
            'semester' => $this->semesterModel->findAll()
        ];
        return view('siswa/index', $data);
    }

    public function profil_siswa()
    {
        $id_user = session()->get('id_user');
        $id_user = session()->get('id_user');
        $siswa = $this->siswaModel->getSiswaById_user($id_user);
        // Ambil nilai berdasarkan id_siswa dari data siswa
        $nilai = $this->nilaiModel->getNilaiByIdSiswa($siswa['id_siswa']);
        $data = [
            'title' => 'Profil',
            'siswa' => $siswa,
            'nilai' => $nilai
        ];
        return view('siswa/profil_siswa', $data);
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
        if ($foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'foto_siswa', $namaFoto);
        } else {
            $namaFoto = 'default_person.jpg';
            copy(FCPATH . 'landingpage/assets/img/team/team-2.jpg', FCPATH . 'foto_siswa/' . $namaFoto);
        }

        // Ambil data dari form
        $id_guru = $this->request->getPost('id_guru');
        $nisn = $this->request->getPost('nisn');
        $nama = $this->request->getPost('nama');

        // Buat akun pengguna (user) untuk siswa
        $userData = [
            'nama' => $nama,
            'username' => $nisn,
            'password' => password_hash($nisn, PASSWORD_DEFAULT), // password default = nisn
            'level' => 'siswa',
            'id_guru' => $id_guru
        ];

        $this->authModel->insert($userData);
        $id_user = $this->authModel->getInsertID(); // Dapatkan ID user yg baru dibuat

        // Data siswa
        $data = [
            'id_user' => $id_user,
            'id_guru' => $id_guru,
            'id_semester' => $this->request->getPost('id_semester'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'nisn' => $nisn,
            'nama' => $nama,
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'foto' => $namaFoto,
        ];

        $this->siswaModel->insert($data);

        return redirect()->to('/kelola_siswa')->with('success', 'Data siswa dan akun berhasil ditambahkan');
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
            'id_semester' => $this->request->getPost('id_semester'),
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
