<?php

namespace App\Models;

use CodeIgniter\Model;

class AksiLayananTIModel extends Model
{
    protected $table = 'Aksi_Layanan_TI';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_pengajuan', 'deskripsi_aksi', 'biaya_penanganan',
        'kwitansi', 'dokumentasi', 'tanggal_aksi'
    ];
}
