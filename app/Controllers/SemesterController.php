<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SemesterModel;

class SemesterController extends BaseController
{

    protected $semesterModel;


    public function __construct()
    {
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
        $allowedLevels = ['wali_kelas', 'guru', 'admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        $data = [
            'title' => 'Semester',
            'semester' => $this->semesterModel->findAll(),
        ];
        return view('semester/index', $data);
    }

    public function proses()
    {
        $id_semester = $this->request->getPost('id_semester');
        $nama_semester = $this->request->getPost('nama_semester');
        $tahun_ajaran = $this->request->getPost('tahun_ajaran');

        if ($id_semester) {
            // Update existing mapel
            $this->semesterModel->update($id_semester, [
                'nama_semester' => $nama_semester,
                'tahun_ajaran' => $tahun_ajaran,
            ]);
            session()->setFlashdata('success', 'Data berhasil diupdate.');
        } else {
            // Insert new mapel
            $this->semesterModel->insert([
                'nama_semester' => $nama_semester,
                'tahun_ajaran' => $tahun_ajaran,
            ]);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        }
        return redirect()->to('/kelola_semester');
    }


    public function delete($id)
    {
        $model = new SemesterModel();
        $model->delete($id);
        return redirect()->to('/kelola_semester')->with('success', 'Data berhasil ditambahkan');
    }
}
