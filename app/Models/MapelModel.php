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
    protected $allowedFields = ['nama_mapel'];


    public function getMapel()
    {
        return $this->db->table($this->table)
            ->get()->getResultArray();
    }
    public function getMapelById($id_mapel)
    {
        return $this->db->table($this->table)
            ->where('id_mapel', $id_mapel)
            ->get()->getRowArray();
    }

}
