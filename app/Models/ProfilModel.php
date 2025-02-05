<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'tb_profil';
    protected $primaryKey = 'id_profil';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['nama_sekolah', 'akreditasi', 'npsn', 'nss', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'bentuk_pendidikan', 'status'];

}
