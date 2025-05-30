<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MapelModel;
use App\Models\GuruModel;

class MapelController extends BaseController
{

    protected $mapelModel;

    protected $guruModel;

    public function __construct()
    {
        $this->mapelModel = new MapelModel();
        $this->guruModel = new GuruModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Mata Pelajaran',
            'mapel' => $this->mapelModel->getMapel(),
            'guru' => $this->guruModel->getGuru(),
        ];
        return view('mapel/index', $data);
    }

    public function proses()
    {
        $id_mapel = $this->request->getPost('id_mapel');
        $nama_mapel = $this->request->getPost('nama_mapel');
        $id_guru = $this->request->getPost('id_guru');

        if ($id_mapel) {
            // Update existing mapel
            $this->mapelModel->update($id_mapel, [
                'nama_mapel' => $nama_mapel,
                'id_guru' => $id_guru,
            ]);
            session()->setFlashdata('success', 'Mata Pelajaran berhasil diupdate.');
        } else {
            // Insert new mapel
            $this->mapelModel->insert([
                'nama_mapel' => $nama_mapel,
                'id_guru' => $id_guru,
            ]);
            session()->setFlashdata('success', 'Mata Pelajaran berhasil ditambahkan.');
        }
        return redirect()->to('/mapel');

    }

    public function hapus($id_mapel)
    {
        $this->mapelModel->delete($id_mapel);
        session()->setFlashdata('success', 'Mata Pelajaran berhasil dihapus.');
        return redirect()->to('/mapel');
    }
}
