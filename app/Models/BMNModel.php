<?php

namespace App\Models;

use CodeIgniter\Model;

class BMNModel extends Model
{
    protected $table = 'BMN';
    protected $primaryKey = 'no_bmn';
    protected $allowedFields = ['no_bmn', 'jenis_perangkat', 'merk', 'tipe', 'serial_number', 'kondisi', 'os', 'nip', 'antivirus', 'office', 'pic1', 'pic2', 'pic3', 'keterangan'];
}
