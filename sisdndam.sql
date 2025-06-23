-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2025 at 12:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisdndam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_semester` int DEFAULT NULL,
  `sakit` int DEFAULT '0',
  `izin` int DEFAULT '0',
  `tanpa_keterangan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absensi`, `id_siswa`, `id_semester`, `sakit`, `izin`, `tanpa_keterangan`) VALUES
(3, 1, 3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_catatan_guru`
--

CREATE TABLE `tb_catatan_guru` (
  `id_catatan` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_semester` int DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_nilai`
--

CREATE TABLE `tb_detail_nilai` (
  `id_detail` int NOT NULL,
  `id_nilai` int DEFAULT NULL,
  `capaian_kompetensi` text,
  `capaian_kompetensi2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_detail_nilai`
--

INSERT INTO `tb_detail_nilai` (`id_detail`, `id_nilai`, `capaian_kompetensi`, `capaian_kompetensi2`) VALUES
(9, 5, 'fgddgdfg', 'dfgdfgdfgdfgfd'),
(10, 6, 'dcssfs', 'fcsfdsfsdfsfdfsd'),
(11, 7, 'Lorem ipsum dolor si amet', 'dolor si amet '),
(12, 8, 'lorem ipsum dolor si amet', 'lorem ipsum dolor si amet'),
(13, 9, 'Lorem ipsum dolor si amet', 'lorem ipsum dolor si amet');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekstrakurikuler`
--

CREATE TABLE `tb_ekstrakurikuler` (
  `id_ekskul` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `id_semester` int DEFAULT NULL,
  `nama_ekskul` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fasilitas`
--

CREATE TABLE `tb_fasilitas` (
  `id_fasilitas` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `foto` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_fasilitas`
--

INSERT INTO `tb_fasilitas` (`id_fasilitas`, `keterangan`, `foto`) VALUES
(2, 'orem Ipsupercetakan dan', '1718247644_89bc2c4d08a650f1cc71.jpg'),
(3, 'orem Ipsum adalah i percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya', '1718247653_99e007fb4a98adc8f2e9.png'),
(4, 'orem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya', '1718247668_e23af5390071afe53406.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto`
--

CREATE TABLE `tb_foto` (
  `id_foto` int NOT NULL,
  `judul` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_foto`
--

INSERT INTO `tb_foto` (`id_foto`, `judul`, `deskripsi`, `foto`, `created_at`) VALUES
(1, 'Hari Pendidikan Nasional', '<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>\r\n', '1717195373_06589faf94b5cb25e50e.jpg', '0000-00-00 00:00:00'),
(2, 'Perlu Bengkel', '<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>\r\n', '1717195454_bed19e0ee6e5a5391a4f.jpg', '0000-00-00 00:00:00'),
(3, 'Siswa SDN 1 DAMIT', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem</p>\r\n', '1717517605_e93f6a5555c0ccd816b8.jpeg', '0000-00-00 00:00:00'),
(4, 'Foto Kelompk', '<p><strong>orem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make</p>\r\n', '1717518218_16614b02dbab02e01028.jpg', '0000-00-00 00:00:00'),
(5, 'ghrhrehrhrh', '<p>ehehheheeee</p>\r\n', '1717518386_189c6dbcac19b04d8882.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int NOT NULL,
  `id_jabatan` int NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `id_jabatan`, `nip`, `nama`, `foto`) VALUES
(1, 1, '630109110902001', 'Demian', '1717493315_0ab9841c4434cf189b6d.jpg'),
(2, 2, '6392823132321', 'Simanjuntak Anawi', '1717493324_d51c88cbd0e31d443cde.jpg'),
(7, 1, '43463463463463', 'Dian Sastro', '1717493417_b6e3d2086a119b19d679.jpg'),
(8, 1, '2310010678', 'Adinda Nurfalah', 'default_person.jpg'),
(9, 1, '23199928312', 'Aidil Rahmat', 'default_person.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int NOT NULL,
  `nama_jabatan` varchar(80) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Guru Bahasa Inggris'),
(2, 'Guru Seni Budaya'),
(3, 'Guru Ilmu Pengetahuan Alam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karya`
--

CREATE TABLE `tb_karya` (
  `id_karya` int NOT NULL,
  `id_guru` int DEFAULT NULL,
  `id_siswa` int DEFAULT NULL,
  `nama_karya` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karya`
--

INSERT INTO `tb_karya` (`id_karya`, `id_guru`, `id_siswa`, `nama_karya`, `deskripsi`, `foto`) VALUES
(1, 2, 3, 'ssdas', 'sdadadasdasdasdas', '1718079610_f80ae29d21bcd40c39ef.jpg'),
(2, 7, 1, 'Sepatu Safty', 'hcheurhfuehvuerubver', '1718079633_355313035e27cceacaae.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int NOT NULL,
  `judul` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `isi` text COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(80) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `judul`, `isi`, `tanggal`, `foto`) VALUES
(1, 'Mesin Air Rusak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2024-05-31', 'default.jpg'),
(2, 'Hari Pendidikan Nasional', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, ', '2024-05-31', 'default.jpg'),
(3, 'Siswa SD Juara 1 dengan PrestasI sebagai Bocil Kematian tingkat dunia ', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled ', '2024-06-10', '1718025205_4d81da3d41b3a4fecf96.png'),
(4, 'Kegiatan Rutin Membersihkan Kelas tiap pagi', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled ', '2024-06-10', '1718025250_75e8413dffd15c55a49f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `foto`) VALUES
(1, '1A', 'img_2.jpg'),
(2, '1B', 'weather-card.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontak`
--

CREATE TABLE `tb_kontak` (
  `id_kontak` int NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kontak`
--

INSERT INTO `tb_kontak` (`id_kontak`, `email`, `no_telp`, `lokasi`) VALUES
(1, 'loremipsuwwwm@gmail.com', '08226173123322', 'Jl. R A Kartini RT 006/RW Kel. DAMIT Kec. BATU AMPAR TANAH LAUT 70811');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int NOT NULL,
  `nama_mapel` varchar(40) DEFAULT NULL,
  `id_guru` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `nama_mapel`, `id_guru`) VALUES
(15, 'Bahasa Indonesia', 8),
(16, 'Matematika', 8),
(17, 'Bahasa Inggris', 1),
(18, 'Ilmu Pengetahuan Alam & Sosial', 2),
(19, 'Pendidikan Al-Qur\'an', 1),
(20, 'Seni Rupa', 1),
(21, 'Pendidikan Jasmani Olahraga dan Kesehata', 2),
(22, 'Pendidikan Pancasila', 2),
(23, 'Ilmu Pengetahuan Alam', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int NOT NULL,
  `id_siswa` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_semester` int DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `tp1` int DEFAULT NULL,
  `tp2` int DEFAULT NULL,
  `tp3` int DEFAULT NULL,
  `tp4` int DEFAULT NULL,
  `tp5` int DEFAULT NULL,
  `tp6` int DEFAULT NULL,
  `tp7` int DEFAULT NULL,
  `tp8` int DEFAULT NULL,
  `tp9` int DEFAULT NULL,
  `tp10` int DEFAULT NULL,
  `tp11` int DEFAULT NULL,
  `tp12` int DEFAULT NULL,
  `tp13` int DEFAULT NULL,
  `tp14` int DEFAULT NULL,
  `tp15` int DEFAULT NULL,
  `tp16` int DEFAULT NULL,
  `tp17` int DEFAULT NULL,
  `tp18` int DEFAULT NULL,
  `tp19` int DEFAULT NULL,
  `tp20` int DEFAULT NULL,
  `rata_formatif` float DEFAULT NULL,
  `sumatif_lingkup_bab1` int DEFAULT NULL,
  `sumatif_lingkup_bab2` int DEFAULT NULL,
  `sumatif_lingkup_bab3` int DEFAULT NULL,
  `sumatif_lingkup_bab4` int DEFAULT NULL,
  `sumatif_lingkup_bab5` int DEFAULT NULL,
  `sumatif_lingkup_bab6` int DEFAULT NULL,
  `sumatif_semester_bab1` int DEFAULT NULL,
  `sumatif_semester_bab2` int DEFAULT NULL,
  `sumatif_semester_bab3` int DEFAULT NULL,
  `sumatif_semester_bab4` int DEFAULT NULL,
  `sumatif_semester_bab5` int DEFAULT NULL,
  `sumatif_semester_bab6` int DEFAULT NULL,
  `rata_sumatif` float DEFAULT NULL,
  `nilai_raport` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `id_siswa`, `id_mapel`, `id_semester`, `id_guru`, `tp1`, `tp2`, `tp3`, `tp4`, `tp5`, `tp6`, `tp7`, `tp8`, `tp9`, `tp10`, `tp11`, `tp12`, `tp13`, `tp14`, `tp15`, `tp16`, `tp17`, `tp18`, `tp19`, `tp20`, `rata_formatif`, `sumatif_lingkup_bab1`, `sumatif_lingkup_bab2`, `sumatif_lingkup_bab3`, `sumatif_lingkup_bab4`, `sumatif_lingkup_bab5`, `sumatif_lingkup_bab6`, `sumatif_semester_bab1`, `sumatif_semester_bab2`, `sumatif_semester_bab3`, `sumatif_semester_bab4`, `sumatif_semester_bab5`, `sumatif_semester_bab6`, `rata_sumatif`, `nilai_raport`, `created_at`, `updated_at`) VALUES
(5, 3, 15, 3, 8, 90, 90, 90, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 88, 80, 90, 0, 0, 0, 0, 80, 80, 0, 0, 0, 0, 83, 86, '2025-05-30 14:27:20', '2025-05-30 14:27:20'),
(6, 3, 16, 3, 8, 80, 80, 60, 60, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 70, 80, 80, 80, 90, 0, 0, 70, 89, 90, 70, 0, 0, 81, 76, '2025-05-30 15:04:27', '2025-05-30 15:04:27'),
(7, 3, 23, 3, 9, 90, 90, 70, 80, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 82, 80, 90, 0, 0, 0, 0, 80, 80, 0, 0, 0, 0, 83, 83, '2025-05-31 06:43:23', '2025-05-31 06:43:23'),
(8, 6, 23, 3, 9, 90, 90, 80, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 85, 90, 90, 0, 0, 0, 0, 80, 80, 0, 0, 0, 0, 85, 85, '2025-05-31 06:46:54', '2025-05-31 06:46:54'),
(9, 3, 17, 3, 1, 90, 80, 80, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 83, 90, 80, 70, 0, 0, 0, 90, 80, 90, 0, 0, 0, 83, 83, '2025-06-02 02:34:46', '2025-06-02 02:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int NOT NULL,
  `nama` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_pengaduan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `nama`, `no_telp`, `judul`, `deskripsi`, `tgl_pengaduan`) VALUES
(3, 'dsfsfsfsf', '5645646', 'dsfdsfs', 'dsfsdfdsf', '2024-06-10 13:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id_profil` int NOT NULL,
  `nama_sekolah` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `akreditasi` enum('A','B','C','D') COLLATE utf8mb4_general_ci NOT NULL,
  `npsn` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `nss` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `kelurahan` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `kecamatan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kabupaten` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `bentuk_pendidikan` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('SWASTA','NEGERI','','') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_profil`
--

INSERT INTO `tb_profil` (`id_profil`, `nama_sekolah`, `akreditasi`, `npsn`, `nss`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `bentuk_pendidikan`, `status`) VALUES
(1, 'UPTD SDN 1 DAMIT', 'A', '32132134242342', '2147483647342', 'JL.RA.Kartini RT.06 Teguhan', 'sdadasdadadssd', 'sdadasd', 'Anjir Barat', 'sdad', 'NEGERI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id_semester` int NOT NULL,
  `nama_semester` enum('1/Ganjil','2/Genap') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tahun_ajaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_semester`
--

INSERT INTO `tb_semester` (`id_semester`, `nama_semester`, `tahun_ajaran`) VALUES
(3, '1/Ganjil', '2025/2026'),
(4, '2/Genap', '2026/2027');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int NOT NULL,
  `id_user` int NOT NULL,
  `id_guru` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_semester` int DEFAULT NULL,
  `nisn` int NOT NULL,
  `nama` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `id_user`, `id_guru`, `id_kelas`, `id_semester`, `nisn`, `nama`, `jenis_kelamin`, `foto`) VALUES
(1, 1, 8, 1, 3, 2147483647, 'Coki Par Die Die', 'Laki-Laki', '1717144260_4cb4d031aa52dcd3d654.jpg'),
(3, 1, 8, 2, 3, 2147483647, 'Hervina', 'Perempuan', 'default_person.jpg'),
(4, 3, 1, 2, 3, 200239231, 'JekiChan', 'Laki-laki', '1719234790_5f390a27a7396232464f.png'),
(5, 3, 1, 1, NULL, 234243, 'dfsfsfs', 'Laki-laki', '1745322060_f0a59bf8a0e069e828a4.jpeg'),
(6, 3, 9, 2, 3, 324234234, 'Ananda', 'Perempuan', '1748618163_63c8f416389ba61c5da9.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tentang`
--

CREATE TABLE `tb_tentang` (
  `id_tentang` int NOT NULL,
  `tentang` text COLLATE utf8mb4_general_ci NOT NULL,
  `visi` text COLLATE utf8mb4_general_ci NOT NULL,
  `misi` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tentang`
--

INSERT INTO `tb_tentang` (`id_tentang`, `tentang`, `visi`, `misi`) VALUES
(1, '<p><strong>lorem ipsum te amett with my wife to be everythinggg</strong></p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only</p>\r\n', '<ul>\r\n	<li><strong>Lorem Ipsum</strong> is simply du</li>\r\n	<li><strong>L</strong>mmy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only</li>\r\n	<li><strong>orem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard du</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `id_guru` int DEFAULT NULL,
  `nama` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('guru','admin','wali_kelas','') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_guru`, `nama`, `username`, `password`, `level`) VALUES
(1, NULL, 'Arif12311', 'Arif1231', '$2y$10$9sGZJ8cgoROVkzWYUn3zDuEqFylJ3qVIbH3MjZ1tVcnRQB0domJV.', 'admin'),
(3, 1, 'Admin123', 'Admin123', '$2y$10$G0K3z6gvEkTlaVPYOkQPq.sWECtIsH58dNGEr6eYc..Y0nKfHNxU.', 'admin'),
(4, NULL, 'Amanda Rawles', 'amandarawles', '$2y$10$XkFskBx6QP.iq69SfExKoO4iQXcfesbfTGheaAcGjQBSftd3yenbe', 'guru'),
(5, NULL, 'aidilrahmat', 'aidilrahmat', '$2y$10$IfcyU4a8xGwVpxerjjFXlue1bE6NalovqdYKTnCh7MXa/RNvAhsGO', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_video`
--

CREATE TABLE `tb_video` (
  `id_video` int NOT NULL,
  `link_video` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_video`
--

INSERT INTO `tb_video` (`id_video`, `link_video`) VALUES
(1, 'https://youtu.be/ERRBZJVMfFM?si=byN-w3hm5h0yK9sD'),
(2, 'https://youtu.be/GkG-lVEI220?si=gk5yM30QbLMQoamV'),
(3, 'https://youtu.be/y_CXsHlXcYE?si=FokW3_rc0hnxX_h0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wilayah`
--

CREATE TABLE `tb_wilayah` (
  `id_wilayah` int NOT NULL,
  `nama_wilayah` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `longitude` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_wilayah`
--

INSERT INTO `tb_wilayah` (`id_wilayah`, `nama_wilayah`, `latitude`, `longitude`, `keterangan`) VALUES
(1, 'UPTD SDN DAMIT 1', '-3.8981549112173672', '114.91060853004456', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `tb_catatan_guru`
--
ALTER TABLE `tb_catatan_guru`
  ADD PRIMARY KEY (`id_catatan`),
  ADD KEY `tb_catatan_guru_ibfk_1` (`id_siswa`),
  ADD KEY `tb_catatan_guru_ibfk_2` (`id_semester`);

--
-- Indexes for table `tb_detail_nilai`
--
ALTER TABLE `tb_detail_nilai`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `tb_detail_nilai_ibfk_1` (`id_nilai`);

--
-- Indexes for table `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  ADD PRIMARY KEY (`id_ekskul`),
  ADD KEY `tb_ekstrakurikuler_ibfk_1` (`id_siswa`),
  ADD KEY `tb_ekstrakurikuler_ibfk_2` (`id_semester`);

--
-- Indexes for table `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_karya`
--
ALTER TABLE `tb_karya`
  ADD PRIMARY KEY (`id_karya`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `fk_nilai_mapel` (`id_mapel`),
  ADD KEY `fk_nilai_semester` (`id_semester`),
  ADD KEY `fk_nilai_siswa` (`id_siswa`);

--
-- Indexes for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indexes for table `tb_tentang`
--
ALTER TABLE `tb_tentang`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `tb_video`
--
ALTER TABLE `tb_video`
  ADD PRIMARY KEY (`id_video`);

--
-- Indexes for table `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_catatan_guru`
--
ALTER TABLE `tb_catatan_guru`
  MODIFY `id_catatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_detail_nilai`
--
ALTER TABLE `tb_detail_nilai`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  MODIFY `id_ekskul` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_fasilitas`
--
ALTER TABLE `tb_fasilitas`
  MODIFY `id_fasilitas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_foto`
--
ALTER TABLE `tb_foto`
  MODIFY `id_foto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_karya`
--
ALTER TABLE `tb_karya`
  MODIFY `id_karya` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  MODIFY `id_kontak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  MODIFY `id_pengaduan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id_profil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `id_semester` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_tentang`
--
ALTER TABLE `tb_tentang`
  MODIFY `id_tentang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_video`
--
ALTER TABLE `tb_video`
  MODIFY `id_video` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  MODIFY `id_wilayah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`),
  ADD CONSTRAINT `tb_absensi_ibfk_2` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`);

--
-- Constraints for table `tb_catatan_guru`
--
ALTER TABLE `tb_catatan_guru`
  ADD CONSTRAINT `tb_catatan_guru_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_catatan_guru_ibfk_2` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_nilai`
--
ALTER TABLE `tb_detail_nilai`
  ADD CONSTRAINT `tb_detail_nilai_ibfk_1` FOREIGN KEY (`id_nilai`) REFERENCES `tb_nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  ADD CONSTRAINT `tb_ekstrakurikuler_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_ekstrakurikuler_ibfk_2` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD CONSTRAINT `tb_guru_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`);

--
-- Constraints for table `tb_karya`
--
ALTER TABLE `tb_karya`
  ADD CONSTRAINT `tb_karya_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`),
  ADD CONSTRAINT `tb_karya_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`);

--
-- Constraints for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD CONSTRAINT `tb_mapel_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `fk_nilai_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id_mapel`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_nilai_semester` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_nilai_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_nilai_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`),
  ADD CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`),
  ADD CONSTRAINT `tb_siswa_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_siswa_ibfk_4` FOREIGN KEY (`id_semester`) REFERENCES `tb_semester` (`id_semester`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
