<?php

namespace App\Models;

use CodeIgniter\Model;

class SprpModel extends Model
{
    protected $table = 'tbl_input_sprp';
    protected $primaryKey = 'id_sprp';
    protected $allowedFields = [
        'kodewilayah', 'id_kategori', 'ISBN', 'jml_arab', 'jml_romawi',
        'kerjasama_instansi', 'id_pembuatcover', 'orientasi', 'diterbitkanuntuk',
        'nama_ukuran', 'id_ukuran'
    ];
}
