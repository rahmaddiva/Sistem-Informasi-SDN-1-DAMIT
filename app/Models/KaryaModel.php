<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryaModel extends Model
{
    protected $table = 'tb_karya';
    protected $primaryKey = 'id_karya';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['id_siswa', 'id_guru', 'nama_karya', 'deskripsi', 'foto'];

    public function getKarya()
    {
        return $this->db->table('tb_karya')
            ->select('tb_karya.*, tb_siswa.nama, tb_guru.nama as nama_pembimbing')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_karya.id_siswa')
            ->join('tb_guru', 'tb_guru.id_guru = tb_karya.id_guru')
            ->get()->getResultArray();
    }

}
