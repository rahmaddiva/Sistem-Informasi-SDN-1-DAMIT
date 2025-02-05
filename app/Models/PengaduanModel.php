<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'tb_pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama', 'no_telp', 'judul', 'deskripsi', 'tgl_pengaduan'];

}
