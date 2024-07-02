<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanLayananModel extends Model
{
    protected $table = 'Pengajuan_Layanan_TI';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nip_lama_user', 'nip_lama_eksekutor', 'id_pihak_ketiga', 'jenis_layanan', 'deskripsi_keluhan',
        'no_bmn', 'deskripsi_keluhan_hardware', 'deskripsi_keluhan_software', 'deskripsi_keluhan_lainnya',
        'status', 'tanggal_pengajuan', 'tanggal_perubahan', 'teknisi', 'status_pengajuan'
    ];
}
