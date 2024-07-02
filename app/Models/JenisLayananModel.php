<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLayananModel extends Model
{
    protected $table = 'jenis_layanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_layanan'];
}
