<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'tb_foto';
    protected $primaryKey = 'id_foto';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['judul', 'deskripsi', 'foto', 'created_at'];

}
