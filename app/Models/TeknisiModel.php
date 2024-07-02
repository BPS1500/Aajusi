<?php

namespace App\Models;

use CodeIgniter\Model;

class TeknisiModel extends Model
{
    protected $table = 'Teknisi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_teknisi', 'nip_lama_teknisi', 'email_teknisi'];
}
