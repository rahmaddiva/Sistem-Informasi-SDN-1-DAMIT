<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanGuruModel extends Model
{
    protected $table = 'tb_catatan_guru';
    protected $primaryKey = 'id_catatan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['id_siswa', 'catatan', 'id_semester'];


}
