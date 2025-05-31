<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NilaiModel;
use App\Models\MapelModel;
use App\Models\SemesterModel;
use App\Models\SiswaModel;
use App\Models\DetailNilaiModel;
use App\Models\CatatanGuruModel;
use App\Models\AbsensiModel;
use App\Models\EkstrakurikulerModel;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiController extends BaseController
{
    protected $nilaiModel;
    protected $mapelModel;
    protected $semesterModel;
    protected $siswaModel;
    protected $detailNilaiModel;
    protected $catatanGuruModel;
    protected $absensiModel;

    protected $ekstrakurikulerModel;


    public function __construct()
    {
        $this->nilaiModel = new NilaiModel();
        $this->mapelModel = new MapelModel();
        $this->semesterModel = new SemesterModel();
        $this->siswaModel = new SiswaModel();
        $this->detailNilaiModel = new DetailNilaiModel();
        $this->catatanGuruModel = new CatatanGuruModel();
        $this->absensiModel = new AbsensiModel();
        $this->ekstrakurikulerModel = new EkstrakurikulerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Nilai',
            'nilai' => $this->nilaiModel->getNilai(),
            'siswa' => $this->siswaModel->getSiswa()
        ];
        return view('nilai/index', $data);
    }

    public function tambah_nilai($id_siswa)
    {
        $id_guru = session()->get('id_guru'); // ambil id guru dari session login
        $siswa = $this->siswaModel->getSiswaById($id_siswa);
        $mapel = $this->mapelModel->getMapelByGuru($id_guru); // hanya mapel yang diampu guru tsb
        $data = [
            'title' => 'Tambah Nilai',
            'siswa' => $siswa,
            'mapel' => $mapel,
            'semester' => $this->semesterModel->getSemesterbyidSiswa($id_siswa),
            'detail_nilai' => $this->detailNilaiModel->getDetailNilai(),
            'nilai_mapel' => $this->nilaiModel->getNilaiMapelBySiswaAndGuru($id_siswa),
            'catatan' => $this->nilaiModel->getSiswaWithEkstraCatatanAbsensi($id_siswa),
        ];
        return view('nilai/tambah_nilai', $data);
    }

    public function simpanMapel()
    {


        $id_siswa = $this->request->getPost('id_siswa');
        $id_mapel = $this->request->getPost('id_mapel');
        $id_semester = $this->request->getPost('id_semester');
        $id_guru = session()->get('id_guru'); // diasumsikan id_guru disimpan di session
        $nilai_raport = $this->request->getPost('nilai_raport');
        $rata_formatif = $this->request->getPost('rata_formatif');
        $rata_sumatif = $this->request->getPost('rata_sumatif');

        // Ambil semua nilai utama
        $data = [
            'id_siswa' => $id_siswa,
            'id_mapel' => $id_mapel,
            'id_semester' => $id_semester,
            'id_guru' => $id_guru,
            'nilai_raport' => $nilai_raport,
            'rata_formatif' => $rata_formatif,
            'rata_sumatif' => $rata_sumatif,
        ];


        // periksa guru mengisi nilai mapel yang sama
        $existingNilai = $this->nilaiModel->where([
            'id_siswa' => $id_siswa,
            'id_mapel' => $id_mapel,
            'id_semester' => $id_semester,
            'id_guru' => $id_guru
        ])->first();

        if ($existingNilai) {
            session()->setFlashdata('error', 'Guru sudah mengisi nilai untuk mata pelajaran ini.');
            return redirect()->to(base_url('/kelola_nilai/tambah/' . $id_siswa));
        }


        // Tambahkan nilai TP (formatif)
        for ($i = 1; $i <= 20; $i++) {
            $data["tp{$i}"] = $this->request->getPost("tp{$i}");
        }

        // Tambahkan nilai sumatif bab
        for ($i = 1; $i <= 6; $i++) {
            $data["sumatif_lingkup_bab{$i}"] = $this->request->getPost("sumatif_lingkup_bab{$i}");
            $data["sumatif_semester_bab{$i}"] = $this->request->getPost("sumatif_semester_bab{$i}");
        }

        // Simpan ke tb_nilai
        $this->nilaiModel->insert($data);
        $id_nilai = $this->nilaiModel->getInsertID(); // ID auto increment terakhir

        // Ambil data detail capaian kompetensi
        $data_detail = [
            'id_nilai' => $id_nilai,
            'capaian_kompetensi' => $this->request->getPost('capaian_kompetensi'),
            'capaian_kompetensi2' => $this->request->getPost('capaian_kompetensi2'),
        ];

        // Simpan ke tb_detail_nilai
        $this->detailNilaiModel->insert($data_detail);
        session()->setFlashdata('success', 'Data Nilai Berhasil Ditambahkan');
        return redirect()->to(base_url('/kelola_nilai/tambah/' . $id_siswa));
    }


    public function simpanEkstra()
    {
        $id_siswa = $this->request->getPost('id_siswa');
        $id_semester = $this->request->getPost('id_semester');

        // Ambil data dari input
        $dataEkstra = [
            'id_siswa' => $id_siswa,
            'id_semester' => $id_semester,
            'nama_ekskul' => $this->request->getPost('nama_ekskul'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        $dataAbsensi = [
            'id_siswa' => $id_siswa,
            'id_semester' => $id_semester,
            'sakit' => $this->request->getPost('sakit') ?? 0,
            'izin' => $this->request->getPost('izin') ?? 0,
            'tanpa_keterangan' => $this->request->getPost('tanpa_keterangan') ?? 0
        ];

        $dataCatatan = [
            'id_siswa' => $id_siswa,
            'id_semester' => $id_semester,
            'catatan' => $this->request->getPost('catatan')
        ];

        try {
            // Simpan ke masing-masing tabel
            $this->ekstrakurikulerModel->insert($dataEkstra);
            $this->absensiModel->insert($dataAbsensi);
            $this->catatanGuruModel->insert($dataCatatan);

            session()->setFlashdata('success', 'Data Ekstrakurikuler, Absensi, dan Catatan berhasil disimpan.');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->to(base_url('/kelola_nilai/tambah/' . $id_siswa));
    }




}
