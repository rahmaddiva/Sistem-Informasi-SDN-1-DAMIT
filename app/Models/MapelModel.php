<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table = 'tb_mapel';
    protected $primaryKey = 'id_mapel';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama_mapel', 'id_guru'];


    public function getMapel()
    {
        return $this->db->table($this->table)
            ->join('tb_guru', 'tb_guru.id_guru = tb_mapel.id_guru')
            ->select('tb_mapel.*, tb_guru.nama')
            ->get()->getResultArray();
    }
    public function getMapelById($id_mapel)
    {
        return $this->db->table($this->table)
            ->where('id_mapel', $id_mapel)
            ->get()->getRowArray();
    }
    public function getMapelByGuru($id_guru)
    {
        return $this->where('id_guru', $id_guru)->findAll();
    }


}
