<?php

namespace App\Models;

use CodeIgniter\Model;

class TentangModel extends Model
{
    protected $table = 'tb_tentang';
    protected $primaryKey = 'id_tentang';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['tentang', 'visi', 'misi'];

}
