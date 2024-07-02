<?php

namespace App\Models;

use CodeIgniter\Model;

class PihakKetigaModel extends Model
{
    protected $table = 'pihak_ketiga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
}
