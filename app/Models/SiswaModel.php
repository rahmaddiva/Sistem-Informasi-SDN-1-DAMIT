<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['id_user', 'id_guru', 'id_kelas', 'id_semester', 'nisn', 'nama', 'jenis_kelamin', 'foto'];

    public function getSiswa()
    {
        return $this->db->table('tb_siswa')
            ->select('tb_siswa.*, tb_guru.nama as nama_guru, tb_kelas.nama_kelas, tb_semester.nama_semester , tb_semester.tahun_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left')
            ->join('tb_guru', 'tb_guru.id_guru = tb_siswa.id_guru')
            ->join('tb_user', 'tb_user.id_user = tb_siswa.id_user', 'left')
            ->join('tb_semester', 'tb_semester.id_semester = tb_siswa.id_semester', 'left')
            ->get()->getResultArray();
    }

    public function getSiswaByKelas($id_kelas)
    {
        return $this->db->table($this->table)
            ->select('tb_siswa.*, tb_guru.nama as nama_guru, tb_kelas.nama_kelas')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
            ->join('tb_guru', 'tb_guru.id_guru = tb_siswa.id_guru')
            ->join('tb_user', 'tb_user.id_user = tb_siswa.id_user')
            ->where('tb_siswa.id_kelas', $id_kelas)
            ->get()->getResultArray();
    }

    public function getSiswaById($id_siswa)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tb_siswa.*, tb_guru.nama as nama_guru, tb_kelas.nama_kelas, tb_semester.nama_semester , tb_semester.tahun_ajaran')
            ->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
            ->join('tb_guru', 'tb_guru.id_guru = tb_siswa.id_guru')
            ->join('tb_user', 'tb_user.id_user = tb_siswa.id_user')
            ->join('tb_semester', 'tb_semester.id_semester = tb_siswa.id_semester')
            ->where('tb_siswa.id_siswa', $id_siswa);
        return $builder->get()->getRowArray();
    }

}
