<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananTIModel extends Model
{
    protected $table = 'Pengajuan_Layanan_TI';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip_lama_user',
        'nip_lama_teknisi',
        'id_pihak_ketiga',
        'jenis_layanan',
        'no_bmn',
        'deskripsi_keluhan_jaringan',
        'deskripsi_keluhan_hardware',
        'deskripsi_keluhan_software',
        'deskripsi_keluhan_lainnya',
        'keterangan_tambahan',
        'status',
        'tanggal_pengajuan',
        'tanggal_perubahan'
    ];
}
