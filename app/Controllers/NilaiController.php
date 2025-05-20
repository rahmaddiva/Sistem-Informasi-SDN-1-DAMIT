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
        $siswa = $this->siswaModel->getSiswaById($id_siswa);
        $mapel = $this->mapelModel->getMapel();
        $data = [
            'title' => 'Tambah Nilai',
            'siswa' => $siswa,
            'mapel' => $mapel,
            'detail_nilai' => $this->detailNilaiModel->getDetailNilai(),
            'nilai_mapel' => $this->nilaiModel->getNilaiMapel($id_siswa),
        ];
        return view('nilai/tambah_nilai', $data);
    }

    public function simpanMapel()
    {
        // id_siswa, id_mapel, id_semester, nilai_akhir, id_guru
        $id_siswa = $this->request->getPost('id_siswa');
        $id_mapel = $this->request->getPost('id_mapel');
        $id_semester = $this->request->getPost('id_semester');
        $nilai_akhir = $this->request->getPost('nilai_akhir');
        $id_guru = session()->get('id_guru');
        $data = [
            'id_siswa' => $id_siswa,
            'id_mapel' => $id_mapel,
            'id_semester' => $id_semester,
            'nilai_akhir' => $nilai_akhir,
            'id_guru' => $id_guru
        ];

        // simpan ke tabel tb_nilai
        $this->nilaiModel->insert($data);
        $id_nilai = $this->nilaiModel->insertID();


        $capaian_kompetensi = $this->request->getPost('capaian_kompetensi');
        $capaian_kompetensi2 = $this->request->getPost('capaian_kompetensi2');
        $data_detail = [
            'id_nilai' => $id_nilai,
            'capaian_kompetensi' => $capaian_kompetensi,
            'capaian_kompetensi2' => $capaian_kompetensi2
        ];
        // simpan ke tabeltb_detail_nilai
        $this->detailNilaiModel->insert($data_detail);
        session()->setFlashdata('success', 'Data Nilai Berhasil Ditambahkan');
        return redirect()->to(base_url('/kelola_nilai/tambah/' . $id_siswa));
    }

    public function simpanEkstra()
    {
        $id_siswa = $this->request->getPost('id_siswa');
        $id_semester = $this->request->getPost('id_semester');
        $nama_ekskul = $this->request->getPost('nama_ekskul');
        $keterangan = $this->request->getPost('keterangan');
        $catatan = $this->request->getPost('catatan');
        $sakit = $this->request->getPost('sakit');
        $izin = $this->request->getPost('izin');
        $tanpa_keterangan = $this->request->getPost('tanpa_keterangan');

        // simpan ke dalam tabel tb_ekstrakurikuler
        $data = [
            'id_siswa' => $id_siswa,
            'id_semester' => $id_semester,
            'nama_ekskul' => $nama_ekskul,
            'keterangan' => $keterangan
        ];
        // simpan ke tabel tb_ekstrakurikuler
        $this->ekstrakurikulerModel->insert($data);
        // simpan ke dalam tabel tb_absensi
        $data_absensi = [
            'id_siswa' => $id_siswa,
            'id_semester' => $id_semester,
            'sakit' => $sakit,
            'izin' => $izin,
            'tanpa_keterangan' => $tanpa_keterangan
        ];
        // simpan ke tabel tb_absensi
        $this->absensiModel->insert($data_absensi);
        // simpan ke dalam tabel tb_catatan_guru
        $data_catatan = [
            'id_siswa' => $id_siswa,
            'id_semester' => $id_semester,
            'catatan' => $catatan
        ];
        // simpan ke tabel tb_catatan_guru
        $this->catatanGuruModel->insert($data_catatan);
        session()->setFlashdata('success', 'Data Ekstrakurikuler Berhasil Ditambahkan');
        return redirect()->to(base_url('/kelola_nilai/tambah/' . $id_siswa));
    }



}
