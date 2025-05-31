<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'tb_nilai';
    protected $primaryKey = 'id_nilai';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = [
        'id_siswa',
        'id_mapel',
        'id_semester',
        'id_guru',
        'nilai_akhir',
        // Tambahan jika kamu menyimpan detail nilai formatif & sumatif
        'tp1',
        'tp2',
        'tp3',
        'tp4',
        'tp5',
        'tp6',
        'tp7',
        'tp8',
        'tp9',
        'tp10',
        'tp11',
        'tp12',
        'tp13',
        'tp14',
        'tp15',
        'tp16',
        'tp17',
        'tp18',
        'tp19',
        'tp20',
        'sumatif_lingkup_bab1',
        'sumatif_lingkup_bab2',
        'sumatif_lingkup_bab3',
        'sumatif_lingkup_bab4',
        'sumatif_lingkup_bab5',
        'sumatif_lingkup_bab6',
        'sumatif_semester_bab1',
        'sumatif_semester_bab2',
        'sumatif_semester_bab3',
        'sumatif_semester_bab4',
        'sumatif_semester_bab5',
        'sumatif_semester_bab6',
        'rata_formatif',
        'rata_sumatif',
        'nilai_raport'
    ];


    public function getNilai()
    {
        return $this->db->table('tb_nilai')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->join('tb_semester', 'tb_semester.id_semester = tb_nilai.id_semester')
            ->get()->getResultArray();
    }

    // ambil data nilai berdasarkan id siswa dan detiail nilai
    public function getNilaiMapel($id_siswa)
    {
        return $this->db->table('tb_nilai')
            ->select('tb_nilai.*, tb_mapel.nama_mapel , tb_detail_nilai.capaian_kompetensi, tb_detail_nilai.capaian_kompetensi2, tb_guru.nama, tb_semester.nama_semester')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')
            ->join('tb_semester', 'tb_semester.id_semester = tb_nilai.id_semester')
            ->join('tb_guru', 'tb_guru.id_guru = tb_nilai.id_guru')
            ->join('tb_detail_nilai', 'tb_detail_nilai.id_nilai = tb_nilai.id_nilai')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->where('tb_nilai.id_siswa', $id_siswa)
            ->get()->getResultArray();
    }

    public function getNilaiMapelBySiswaAndGuru($id_siswa)
    {
        return $this->where('id_siswa', $id_siswa)
            ->select('tb_nilai.*, tb_mapel.nama_mapel, tb_detail_nilai.capaian_kompetensi, tb_detail_nilai.capaian_kompetensi2, tb_guru.nama, tb_semester.nama_semester')
            ->join('tb_semester', 'tb_semester.id_semester = tb_nilai.id_semester')
            ->join('tb_guru', 'tb_guru.id_guru = tb_nilai.id_guru')
            ->join('tb_detail_nilai', 'tb_detail_nilai.id_nilai = tb_nilai.id_nilai')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->get()->getResultArray();
    }


    // ambil data siswa ekstrakurikuler, catatan guru, absensi
    public function getSiswaWithEkstraCatatanAbsensi($id_siswa)
    {
        return $this->db->table('tb_siswa')
            ->select('
                tb_siswa.*,
                tb_ekstrakurikuler.nama_ekskul,
                tb_ekstrakurikuler.keterangan AS keterangan_ekskul,
                tb_absensi.sakit,
                tb_absensi.izin,
                tb_absensi.tanpa_keterangan,
                tb_catatan_guru.catatan
            ')
            ->join('tb_ekstrakurikuler', 'tb_ekstrakurikuler.id_siswa = tb_siswa.id_siswa', 'left')
            ->join('tb_absensi', 'tb_absensi.id_siswa = tb_siswa.id_siswa', 'left')
            ->join('tb_catatan_guru', 'tb_catatan_guru.id_siswa = tb_siswa.id_siswa', 'left')
            ->where('tb_siswa.id_siswa', $id_siswa)
            ->get()->getResultArray();
    }



}
