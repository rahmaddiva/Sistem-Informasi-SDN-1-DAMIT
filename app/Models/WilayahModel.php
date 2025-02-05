<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'tb_wilayah';
    protected $primaryKey = 'id_wilayah';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama_wilayah', 'latitude', 'longitude', 'keterangan'];

}
