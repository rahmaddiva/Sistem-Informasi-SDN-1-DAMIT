<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailNilaiModel extends Model
{
    protected $table = 'tb_detail_nilai';
    protected $primaryKey = 'id_detail';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['id_nilai', 'capaian_kompetensi', 'capaian_kompetensi2'];


    public function getDetailNilai()
    {
        return $this->db->table($this->table)
            ->join('tb_nilai', 'tb_nilai.id_nilai = tb_detail_nilai.id_nilai')
            ->join('tb_mapel', 'tb_mapel.id_mapel = tb_nilai.id_mapel')
            ->get()->getResultArray();
    }

}
