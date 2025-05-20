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
    protected $allowedFields = ['id_siswa', 'id_mapel', 'id_semester', 'nilai_akhir', 'id_guru'];

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
            ->select('tb_nilai.*, tb_mapel.nama_mapel , tb_detail_nilai.capaian_kompetensi, tb_detail_nilai.capaian_kompetensi2, tb_guru.nama')
            ->join('tb_guru', 'tb_guru.id_guru = tb_nilai.id_guru')
            ->join('tb_detail_nilai', 'tb_detail_nilai.id_nilai = tb_nilai.id_nilai')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->where('tb_nilai.id_siswa', $id_siswa)
            ->get()->getResultArray();
    }



}
