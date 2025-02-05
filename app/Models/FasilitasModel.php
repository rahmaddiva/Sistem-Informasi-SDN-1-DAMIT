<?php

namespace App\Models;

use CodeIgniter\Model;

class FasilitasModel extends Model
{
    protected $table = 'tb_fasilitas';
    protected $primaryKey = 'id_fasilitas';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['keterangan', 'foto'];

}
