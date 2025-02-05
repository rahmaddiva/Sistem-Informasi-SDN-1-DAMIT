<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakModel extends Model
{
    protected $table            = 'tb_kontak';
    protected $primaryKey       = 'id_kontak';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $protectFields    = true;
    protected $allowedFields    = ['email' , 'no_telp' , 'lokasi'];

}
