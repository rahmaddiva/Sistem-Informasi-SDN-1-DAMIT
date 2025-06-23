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
use App\Models\KelasModel;
use App\Models\EkstrakurikulerModel;
use Dompdf\Dompdf;

use App\Libraries\GoogleSheetService;

class NilaiController extends BaseController
{
    protected $nilaiModel;
    protected $mapelModel;
    protected $semesterModel;
    protected $siswaModel;
    protected $detailNilaiModel;
    protected $catatanGuruModel;
    protected $absensiModel;
    protected $kelasModel;
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
        $this->kelasModel = new KelasModel();
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }

        // Inisialisasi Google Sheets Service
    }

    public function index()
    {

       
        $session = session();
        $allowedLevels = ['wali_kelas', 'guru', 'admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }


        $data = [
            'title' => 'Kelola Nilai',
            'nilai' => $this->nilaiModel->getNilai(),
            'siswa' => $this->siswaModel->getSiswa(),
            'kelas' => $this->kelasModel->findAll(),
            'mapel' => $this->mapelModel->getMapelByGuru(session()->get('id_guru')), // hanya mapel yang diampu guru tsb
        ];
        return view('nilai/index', $data);
    }



    public function dataSiswaWaliKelas()
    {
        $session = session();

        $session = session();
        $allowedLevels = ['wali_kelas', 'guru', 'admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $siswaModel = new \App\Models\SiswaModel();
        $kelasModel = new \App\Models\KelasModel();

        $data['title'] = 'Wali Kelas';
        $data['kelas'] = $kelasModel->findAll();
        $data['mapel'] = $this->mapelModel->findAll();

        if ($isAdmin) {
            // Admin: ambil semua siswa
            $data['siswa'] = $siswaModel
                ->select('tb_siswa.*, tb_guru.nama as nama_guru, tb_kelas.nama_kelas')
                ->join('tb_guru', 'tb_guru.id_guru = tb_siswa.id_guru', 'left')
                ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left')
                ->findAll();
        } else {
            // Guru: hanya siswa yang diampu
            $data['siswa'] = $siswaModel
                ->select('tb_siswa.*, tb_guru.nama as nama_guru, tb_kelas.nama_kelas')
                ->join('tb_guru', 'tb_guru.id_guru = tb_siswa.id_guru', 'left')
                ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left')
                ->where('tb_siswa.id_guru', $idGuruLogin)
                ->findAll();
        }

        return view('nilai/wali_kelas', $data);
    }


    public function tambah_nilai($id_siswa)
    {
        $session = session();
        $allowedLevels = ['wali_kelas', 'guru', 'admin'];
        if (!in_array($session->get('level'), $allowedLevels)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

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

    public function deleteNilai($id_nilai)
    {
        // Cari data nilai
        $nilai = $this->nilaiModel->find($id_nilai);
        if (!$nilai) {
            session()->setFlashdata('error', 'Data nilai tidak ditemukan.');
            return redirect()->back();
        }

        // Hapus detail nilai terkait
        $this->detailNilaiModel->where('id_nilai', $id_nilai)->delete();

        // Hapus data nilai utama
        $this->nilaiModel->delete($id_nilai);

        session()->setFlashdata('success', 'Data nilai berhasil dihapus.');
        return redirect()->to(base_url('/kelola_nilai/tambah/' . $nilai['id_siswa']));
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

    public function cetakRaporSemua()
    {

        $session = session();

        $idGuruLogin = $session->get('id_guru');


        $nilaiModel = new \App\Models\NilaiModel();
        $catatanModel = new \App\Models\CatatanGuruModel();
        $ekskulModel = new \App\Models\EkstrakurikulerModel();
        $absensiModel = new \App\Models\AbsensiModel();

        $semuaSiswa = $nilaiModel->select('tb_siswa.id_siswa, tb_siswa.nama, tb_siswa.nisn, tb_kelas.nama_kelas')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
            ->distinct()
            ->where('tb_nilai.id_guru', $idGuruLogin) // hanya siswa yang diampu guru tsb
            ->findAll();
        $dataSiswaRapor = [];

        foreach ($semuaSiswa as $siswa) {
            $nilaiList = $nilaiModel
                ->select('
                    tb_mapel.nama_mapel, 
                    tb_nilai.nilai_raport, 
                    tb_detail_nilai.capaian_kompetensi, 
                    tb_detail_nilai.capaian_kompetensi2, 
                    tb_kelas.nama_kelas,
                    tb_semester.nama_semester,
                    tb_semester.tahun_ajaran,
                    tb_nilai.id_semester
                ')
                ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
                ->join('tb_detail_nilai', 'tb_detail_nilai.id_nilai = tb_nilai.id_nilai')
                ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
                ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
                ->join('tb_semester', 'tb_semester.id_semester = tb_nilai.id_semester')
                ->where('tb_nilai.id_guru', $idGuruLogin) // hanya nilai yang diampu guru tsb
                ->findAll();

            $id_semester = !empty($nilaiList) ? $nilaiList[0]['id_semester'] ?? null : null;

            $catatan = $catatanModel
                ->where('id_siswa', $siswa['id_siswa'])
                ->where('id_semester', $id_semester)
                ->first();

            $ekskul = $ekskulModel
                ->where('id_siswa', $siswa['id_siswa'])
                ->where('id_semester', $id_semester)
                ->findAll();

            $absensi = $absensiModel
                ->where('id_siswa', $siswa['id_siswa'])
                ->where('id_semester', $id_semester)
                ->first();

            $dataSiswaRapor[] = [
                'siswa' => $siswa,
                'nilaiList' => $nilaiList,
                'kelas' => !empty($nilaiList) ? $nilaiList[0]['nama_kelas'] : '-',
                'semester' => !empty($nilaiList) ? $nilaiList[0]['nama_semester'] : '-',
                'tahun_pelajaran' => !empty($nilaiList) ? $nilaiList[0]['tahun_ajaran'] : '-',
                'catatan' => $catatan['catatan'] ?? '',
                'ekskul' => $ekskul,
                'absensi' => [
                    'sakit' => $absensi['sakit'] ?? 0,
                    'izin' => $absensi['izin'] ?? 0,
                    'tanpa_keterangan' => $absensi['tanpa_keterangan'] ?? 0
                ]
            ];
        }

        $data = [
            'dataRapor' => $dataSiswaRapor,
            'nama_sekolah' => 'UPTD SD Negeri 1 Damit',
            'alamat_sekolah' => 'Jl. R.A. Kartini RT.06 Teguhan'
        ];

        $dompdf = new \Dompdf\Dompdf();
        $html = view('nilai/rapor_semua_template_pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Rapor_Semua_Siswa.pdf', ['Attachment' => false]);
    }



    public function cetakRapor($id_siswa)
    {
        $siswaModel = new \App\Models\SiswaModel();
        $nilaiModel = new \App\Models\NilaiModel();
        $ekskulModel = new \App\Models\EkstrakurikulerModel();
        $catatanGuruModel = new \App\Models\CatatanGuruModel();
        $absensiModel = new \App\Models\AbsensiModel();

        $siswa = $siswaModel->find($id_siswa);

        // Ambil nilai dan informasi semester
        $nilaiList = $nilaiModel
            ->select('
                tb_mapel.nama_mapel, 
                tb_nilai.nilai_raport, 
                tb_detail_nilai.capaian_kompetensi, 
                tb_detail_nilai.capaian_kompetensi2, 
                tb_kelas.nama_kelas,
                tb_semester.nama_semester,
                tb_semester.tahun_ajaran,
                tb_nilai.id_semester
            ')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->join('tb_detail_nilai', 'tb_detail_nilai.id_nilai = tb_nilai.id_nilai')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
            ->join('tb_semester', 'tb_semester.id_semester = tb_nilai.id_semester')
            ->where('tb_nilai.id_siswa', $id_siswa)
            ->findAll();

        // Ambil id_semester dari data nilai (gunakan yang pertama)
        $id_semester = !empty($nilaiList) ? $nilaiList[0]['id_semester'] : null;

        // Ambil data ekstrakurikuler
        $ekstrakurikulerList = $id_semester ? $ekskulModel
            ->where('id_siswa', $id_siswa)
            ->where('id_semester', $id_semester)
            ->findAll() : [];

        // Ambil data catatan guru
        $catatan = $id_semester ? $catatanGuruModel
            ->where('id_siswa', $id_siswa)
            ->where('id_semester', $id_semester)
            ->first() : null;
        $catatan_guru = $catatan['catatan'] ?? null;

        // Ambil data absensi
        $absensi = $id_semester ? $absensiModel
            ->where('id_siswa', $id_siswa)
            ->where('id_semester', $id_semester)
            ->first() : null;
        $sakit = $absensi['sakit'] ?? 0;
        $izin = $absensi['izin'] ?? 0;
        $tanpa_keterangan = $absensi['tanpa_keterangan'] ?? 0;

        $data = [
            'siswa' => $siswa,
            'nilaiList' => $nilaiList,
            'kelas' => !empty($nilaiList) ? $nilaiList[0]['nama_kelas'] : 'Tidak Diketahui',
            'semester' => !empty($nilaiList) ? $nilaiList[0]['nama_semester'] : '-',
            'tahun_pelajaran' => !empty($nilaiList) ? $nilaiList[0]['tahun_ajaran'] : '-',
            'nama_sekolah' => 'UPTD SD Negeri 1 Damit',
            'alamat_sekolah' => 'Jl. R.A. Kartini RT.06 Teguhan',
            'ekstrakurikulerList' => $ekstrakurikulerList,
            'catatan_guru' => $catatan_guru,
            'sakit' => $sakit,
            'izin' => $izin,
            'tanpa_keterangan' => $tanpa_keterangan,
        ];

        $dompdf = new \Dompdf\Dompdf();
        $html = view('nilai/rapor_template_pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Rapor_' . $siswa['nama'] . '.pdf', ['Attachment' => false]);
    }

    public function rekapPdf()
    {
        $data['nilai'] = $this->nilaiModel
            ->select('tb_nilai.*, tb_siswa.nama as nama_siswa, tb_siswa.nisn, tb_kelas.nama_kelas, tb_guru.nama, tb_mapel.nama_mapel, tb_semester.nama_semester , tb_semester.tahun_ajaran')
            ->join('tb_semester', 'tb_semester.id_semester = tb_nilai.id_semester')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
            ->join('tb_guru', 'tb_guru.id_guru = tb_nilai.id_guru')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->findAll();

        $html = view('nilai/rekap_nilai', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("rekap_nilai.pdf", ["Attachment" => false]);
    }

    public function rekapExcel()
    {
        $dataNilai = $this->nilaiModel
            ->select('tb_nilai.*, tb_siswa.nama as nama_siswa, tb_mapel.nama_mapel')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->orderBy('tb_mapel.nama_mapel')
            ->orderBy('tb_siswa.nama')
            ->findAll();

        $spreadsheetId = '1ZiZntpOev8gtfL6fSj_J4hQiK0Tz5LsCXBJrmIGIx24';
        $sheetService = new \App\Libraries\GoogleSheetService();

        $rekap = [];

        foreach ($dataNilai as $row) {
            $mapel = $row['nama_mapel'];
            $siswa = $row['nama_siswa'];

            $rekap[$mapel][$siswa] = [
                'tp' => [],
                'sumatif_bab' => [],
                'sumatif_semester' => [],
                'nilai_akhir' => $row['nilai_akhir'] ?? '',
                'rata_formatif' => $row['rata_formatif'] ?? '',
                'rata_sumatif' => $row['rata_sumatif'] ?? '',
                'nilai_raport' => $row['nilai_raport'] ?? '',
            ];

            for ($i = 1; $i <= 20; $i++) {
                $rekap[$mapel][$siswa]['tp'][] = $row['tp' . $i] ?? '';
            }

            for ($i = 1; $i <= 6; $i++) {
                $rekap[$mapel][$siswa]['sumatif_bab'][] = $row["sumatif_lingkup_bab{$i}"] ?? '';
            }

            for ($i = 1; $i <= 6; $i++) {
                $rekap[$mapel][$siswa]['sumatif_semester'][] = $row["sumatif_semester_bab{$i}"] ?? '';
            }
        }

        foreach ($rekap as $mapel => $dataSiswa) {
            $headers = ['Nama Siswa'];

            for ($i = 1; $i <= 20; $i++) {
                $headers[] = 'TP ' . $i;
            }

            $headers[] = 'Nilai Akhir';

            for ($i = 1; $i <= 6; $i++) {
                $headers[] = 'Sumatif Bab ' . $i;
            }

            for ($i = 1; $i <= 6; $i++) {
                $headers[] = 'Sumatif Semester Bab ' . $i;
            }

            $headers[] = 'Rata Formatif';
            $headers[] = 'Rata Sumatif';
            $headers[] = 'Nilai Raport';

            $rows = [$headers];

            foreach ($dataSiswa as $nama => $nilai) {
                $row = [$nama];
                $row = array_merge(
                    $row,
                    $nilai['tp'],
                    [$nilai['nilai_akhir']],
                    $nilai['sumatif_bab'],
                    $nilai['sumatif_semester'],
                    [$nilai['rata_formatif'], $nilai['rata_sumatif'], $nilai['nilai_raport']]
                );
                $rows[] = $row;
            }

            $sheetTitle = 'Rekap Nilai ' . $mapel;
            $sheetService->clearAndWriteToSheetByTitle($spreadsheetId, $sheetTitle, $rows);
        }

        return redirect()->to('/wali_kelas')->with('success', 'Rekap nilai per mata pelajaran berhasil dikirim ke Google Spreadsheet!');
    }
}
