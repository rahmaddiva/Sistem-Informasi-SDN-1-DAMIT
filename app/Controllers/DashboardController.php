<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\GuruModel;
use App\Models\KegiatanModel;
use App\Models\KontakModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\TentangModel;
use App\Models\FotoModel;
use App\Models\ProfilModel;
use App\Models\VideoModel;

class DashboardController extends BaseController
{

    protected $guruModel;

    protected $kegiatanModel;

    protected $kontakModel;

    protected $kelasModel;

    protected $siswaModel;

    protected $tentangModel;

    protected $fotoModel;

    protected $profilModel;

    protected $videoModel;

    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->kontakModel = new KontakModel();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->tentangModel = new TentangModel();
        $this->fotoModel = new FotoModel();
        $this->profilModel = new ProfilModel();
        $this->videoModel = new VideoModel();
    }

    public function index()
    {
        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }
        $kegiatan = $this->kegiatanModel->findAll();

        // Siapkan array untuk menampung data kegiatan dalam format yang dibutuhkan oleh FullCalendar
        $events = [];
        foreach ($kegiatan as $k) {
            $events[] = [
                'title' => $k['judul'],
                'start' => $k['tanggal'], // Pastikan tanggal sudah dalam format 'YYYY-MM-DD'
                'description' => $k['isi'] // Deskripsi bisa ditambahkan untuk ditampilkan di swal
            ];
        }
        $data = [
            'title' => 'Dashboard',
            'siswa' => $this->siswaModel->countAll(),
            'guru' => $this->guruModel->countAll(),
            'kelas' => $this->kelasModel->countAll(),
            'kegiatan' => $this->kegiatanModel->countAll(),
            'tanggal_kegiatan' => $events
        ];
        return view('dashboard/index', $data);
    }

    public function landingpage()
    {
        // Load pager library
        $pager = \Config\Services::pager();

        // Ambil data foto dari model dengan pagination
        $data['foto'] = $this->fotoModel->paginate(3); // 6 adalah jumlah data per halaman

        // Ambil data kegiatan dari model dengan pagination
        $data['kegiatan'] = $this->kegiatanModel->paginate(3); // 6 adalah jumlah data per halaman

        // Konfigurasi pagination untuk foto
        $data['pager_foto'] = $this->fotoModel->pager;

        // Konfigurasi pagination untuk kegiatan
        $data['pager_kegiatan'] = $this->kegiatanModel->pager;

        // Data lainnya
        $data['title'] = 'UPTD SD NEGERI 1 DAMIT';
        $data['guru'] = $this->guruModel->getGuru();
        $data['kelas'] = $this->kelasModel->findAll();
        $data['siswa'] = $this->siswaModel->getSiswa();
        $data['tentang'] = $this->tentangModel->findAll();
        $data['kontak'] = $this->kontakModel->findAll();
        $data['profil'] = $this->profilModel->findAll();
        $data['video'] = $this->videoModel->findAll();
        $data['jumlah_siswa'] = $this->siswaModel->countAll();
        $data['jumlah_kelas'] = $this->kelasModel->countAll();
        $data['jumlah_guru'] = $this->guruModel->countAll();
        $data['jumlah_kegiatan'] = $this->kegiatanModel->countAll();

        // Tampilkan view dengan data dan pagination
        return view('dashboard/landingpage', $data);
    }


}
