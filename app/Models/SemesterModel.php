<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{
    protected $table = 'tb_semester';
    protected $primaryKey = 'id_semester';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $protectFields = true;
    protected $allowedFields = ['nama_semester', 'tahun_ajaran'];


    public function getSemesterbyidSiswa($id_siswa)
    {
        return $this->db->table('tb_semester')
            ->join('tb_siswa', 'tb_siswa.id_semester = tb_semester.id_semester')
            ->where('tb_siswa.id_siswa', $id_siswa)
            ->get()->getResultArray();
    }

}
