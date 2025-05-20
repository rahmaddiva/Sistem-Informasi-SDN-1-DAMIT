<?php

namespace App\Models;

use CodeIgniter\Model;

class EkstrakurikulerModel extends Model
{
    protected $table = 'tb_ekstrakurikuler';
    protected $primaryKey = 'id_ekskul';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_siswa', 'id_semester', 'nama_ekskul', 'keterangan'];



}
