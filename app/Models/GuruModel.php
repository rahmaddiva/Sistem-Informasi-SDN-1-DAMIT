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
    protected $allowedFields = ['id_jabatan', 'nip', 'nama', 'foto'];

    public function getGuru()
    {
        return $this->db->table('tb_guru')
            ->select('tb_guru.*, tb_jabatan.nama_jabatan')
            ->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_guru.id_jabatan')
            ->get()->getResultArray();
    }
}
