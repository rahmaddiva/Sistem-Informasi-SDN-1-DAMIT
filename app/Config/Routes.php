<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::landingpage');
$routes->get('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/proses_login', 'AuthController::proses_login');
$routes->get('/dashboard', 'DashboardController::index');

// kelola akun
$routes->get('/kelola_akun', 'AuthController::kelola_akun');
$routes->post('/proses_akun', 'AuthController::proses_akun');
$routes->post('/update_akun', 'AuthController::update_akun');
$routes->get('/hapus/(:num)', 'AuthController::hapus/$1');

// kelola guru
$routes->get('/kelola_guru', 'GuruController::index');
$routes->post('/proses_guru', 'GuruController::proses_guru');
$routes->post('/update_guru', 'GuruController::update_guru');
$routes->get('/hapus_guru/(:num)', 'GuruController::hapus_guru/$1');

// kelola jabatan
$routes->get('/kelola_jabatan', 'JabatanController::index');
$routes->post('/proses_jabatan', 'JabatanController::proses_jabatan');
$routes->post('/update_jabatan', 'JabatanController::update_jabatan');
$routes->get('/hapus_jabatan/(:num)', 'JabatanController::hapus_jabatan/$1');

// kelola kelas
$routes->get('/kelola_kelas', 'KelasController::index');
$routes->post('/proses_kelas', 'KelasController::proses_kelas');
$routes->post('/update_kelas', 'KelasController::update_kelas');
$routes->get('/hapus_kelas/(:num)', 'KelasController::hapus_kelas/$1');

// kelola siswa
$routes->get('/kelola_siswa', 'SiswaController::index');
$routes->post('/proses_siswa', 'SiswaController::proses_siswa');
$routes->post('/update_siswa', 'SiswaController::update_siswa');
$routes->get('/hapus_siswa/(:num)', 'SiswaController::hapus_siswa/$1');

// kelola profil
$routes->get('/kelola_profil', 'ProfilController::index');
$routes->post('/update_profil', 'ProfilController::update_profil');

// kelola tentang
$routes->get('/kelola_tentang', 'TentangController::index');
$routes->post('/update_tentang', 'TentangController::update_tentang');

// kelola kontak
$routes->get('/kelola_kontak', 'KontakController::index');
$routes->post('/update_kontak', 'KontakController::update_kontak');

// kelola kegiatan
$routes->get('/kelola_kegiatan', 'KegiatanController::index');
$routes->post('/proses_kegiatan', 'KegiatanController::proses_kegiatan');
$routes->post('/update_kegiatan', 'KegiatanController::update_kegiatan');
$routes->get('/hapus_kegiatan/(:num)', 'KegiatanController::hapus_kegiatan/$1');
$routes->get('kegiatan/(:any)', 'KegiatanController::detail_kegiatan/$1');

// kelola foto
$routes->get('/kelola_foto', 'FotoController::index');
$routes->post('/proses_foto', 'FotoController::proses_foto');
$routes->post('/update_foto/(:num)', 'FotoController::update_foto/$1');
$routes->get('/hapus_foto/(:num)', 'FotoController::hapus_foto/$1');

// kelola karya
$routes->get('/kelola_karya', 'KaryaController::index');
$routes->get('/karya', 'KaryaController::karya');
$routes->post('/proses_karya', 'KaryaController::proses_karya');
$routes->post('/update_karya', 'KaryaController::update_karya');
$routes->get('/hapus_karya/(:num)', 'KaryaController::hapus_karya/$1');

// kelola wilayah
$routes->get('/kelola_wilayah', 'WilayahController::index');
$routes->post('/update_wilayah', 'WilayahController::update_wilayah');
$routes->get('/wilayah', 'WilayahController::wilayah');

// kelola pengaduan 
$routes->get('/pengaduan', 'PengaduanController::index');
$routes->post('/proses_pengaduan', 'PengaduanController::proses_pengaduan');
$routes->get('/hapus_pengaduan/(:num)', 'PengaduanController::hapus_pengaduan/$1');

// profil sekolah
$routes->get('/profil_sekolah', 'ProfilController::profil_sekolah');
// siswa
$routes->get('/siswa', 'SiswaController::kelas');
$routes->get('siswa/siswaByKelas/(:num)', 'SiswaController::siswaByKelas/$1');

// kelola_video
$routes->get('/kelola_video', 'VideoController::index');
$routes->get('/video', 'VideoController::video');
$routes->post('/proses_video', 'VideoController::proses_video');
$routes->post('/update_video/(:num)', 'VideoController::update_video/$1');
$routes->get('/hapus_video/(:num)', 'VideoController::delete_video/$1');

// kelola Fasilitas
$routes->get('/kelola_fasilitas', 'FasilitasController::index');
$routes->get('/fasilitas', 'FasilitasController::fasilitas');
$routes->post('/proses_fasilitas', 'FasilitasController::proses_fasilitas');
$routes->post('/update_fasilitas', 'FasilitasController::update_fasilitas');
$routes->get('/hapus_fasilitas/(:num)', 'FasilitasController::hapus_fasilitas/$1');

// kelola nilai
$routes->get('/kelola_nilai', 'NilaiController::index');
$routes->get('/kelola_nilai/tambah/(:num)', 'NilaiController::tambah_nilai/$1');
$routes->post('/nilai/simpanMapel', 'NilaiController::simpanMapel');





