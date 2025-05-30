<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'tb_guru';
    protected $primaryKey = 'id_guru';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['id_jabatan', 'nip', 'id_mapel1', 'id_mapel2', 'nama', 'foto'];

    public function getGuru()
    {
        return $this->db->table('tb_guru')
            ->select('tb_guru.*, tb_jabatan.nama_jabatan, tb_mapel1.nama_mapel AS nama_mapel1, tb_mapel2.nama_mapel AS nama_mapel2')
            ->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_guru.id_jabatan')
            ->join('tb_mapel AS tb_mapel1', 'tb_mapel1.id_mapel = tb_guru.id_mapel1', 'left')
            ->join('tb_mapel AS tb_mapel2', 'tb_mapel2.id_mapel = tb_guru.id_mapel2', 'left')
            ->get()->getResultArray();

    }
}
