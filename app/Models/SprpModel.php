<?php

namespace App\Models;

use CodeIgniter\Model;

class SprpModel extends Model
{
    protected $table = 'tbl_input_sprp';
    protected $primaryKey = 'id_sprp';
    protected $allowedFields = ['id',
        'kodewilayah', 'id_kategori', 'ISBN', 'jml_arab', 'jml_romawi',
        'kerjasama_instansi', 'id_cover', 'id_orientasi', 'id_diterbit',
        'nama_ukuran', 'id_ukuran', 'nomor_publikasi'
    ];

    // public function updateNomorPublikasi($id, $nomorPublikasi)
    // {
    //     $data = [
    //         'nomor_publikasi' => $nomorPublikasi,
    //     ];

    //     return $this->update($id, $data);
    // }

    public function getWilayah()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_wilayah');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getKategori()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_kategoripublikasi');
        $query = $builder->get();
        return $query->getResultArray();
    }

    

    public function getJenispublikasi()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_jenispublikasi');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCover()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_pembuatcover');
        $query = $builder->get();
        return $query->getResultArray();
    }

   
    public function getUkuran()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_ukuran');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPublikasi()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_masterpublikasi');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTerbit()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_diterbitkan');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getOrientasi()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_orientasi');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getKategoriName($id_kategori)
{
    $db = \Config\Database::connect();
    $builder = $db->table('mst_kategoripublikasi');
    $builder->where('id_kategori', $id_kategori);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['kategori_pub'] ?? 'Data Tidak Terbaca';
}

public function getWilayahName($kodewilayah)
{
    $db = \Config\Database::connect();
    $builder = $db->table('mst_wilayah');
    $builder->where('kodewilayah', $kodewilayah);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['nama_wilayah'] ?? 'Data Tidak Terbaca';
}

public function getCoverName($id_cover)
{
    $db = \Config\Database::connect();
    $builder = $db->table('mst_pembuatcover');
    $builder->where('id_cover', $id_cover);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['pembuat_cover'] ?? 'Data Tidak Terbaca';
}

public function getOrientasiName($id_orientasi)
{
    $db = \Config\Database::connect();
    $builder = $db->table('mst_orientasi');
    $builder->where('id_orientasi', $id_orientasi);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['orientasi'] ?? 'Data Tidak Terbaca';
}

public function getTerbitName($id_diterbit)
{
    $db = \Config\Database::connect();
    $builder = $db->table('mst_diterbitkan');
    $builder->where('id_diterbit', $id_diterbit);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['diterbitkanuntuk'] ?? 'Data Tidak Terbaca';
}

public function getUkuranName($id_ukuran)
{
    $db = \Config\Database::connect();
    $builder = $db->table('mst_ukuran');
    $builder->where('id_ukuran', $id_ukuran);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['nama_ukuran'] ?? 'Data Tidak Terbaca';

}

public function getJenispublikasiName($id_jenispublikasi)
{
    $db = \Config\Database::connect();
    $builder = $db->table('tbl_jenispublikasi');
    $builder->where('id_jenispublikasi', $id_jenispublikasi);
    $query = $builder->get();
    $result = $query->getRowArray();
    return $result['jenis_publikasi'] ?? 'Data Tidak Terbaca';

}

public function getPublikasiDetails($id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('tbl_masterpublikasi');

            // Assuming $id should be an integer. Adjust type casting if necessary.
            if (!is_numeric($id)) {
                throw new \InvalidArgumentException('ID must be an integer.');
            }

            $builder->select('katalog, judul_publikasi_ind, judul_publikasi_eng, no_issn, id_jenispublikasi');
            $builder->where('id', (int) $id);
            $query = $builder->get();
            return $query->getRowArray();
}

public function Add($data)
{
    $this->db->table('tbl_input_sprp')->insert($data);
}

public function delete_tbl_input_sprp($id_sprp)
{
    return $this->db->table('tbl_input_sprp')->delete(['id_sprp' => $id_sprp]);
}

public function getDataForUpdate($id_sprp)
{
    return $this->db->table('tbl_input_sprp')->where('id_sprp', $id_sprp)->get()->getResultArray();
}

public function updateData($id_sprp, $data)
{
    return $this->db->table('tbl_input_sprp')->update($data, ['id_sprp' => $id_sprp]);
}

// public function getNomorPublikasi()
//     {
//         $db = \Config\Database::connect();
//         $builder = $db->table('mst_nomorpub');
//         $query = $builder->get();
//         return $query->getResultArray();
//     }

// public function getNomorPub($id_nomorpub)
// {
//     $db = \Config\Database::connect();
//     $builder = $db->table('mst_nomorpub');
//     $builder->where('id_nomorpub', $id_nomorpub);
//     $query = $builder->get();
//     $result = $query->getRowArray();
//     return $result['nomor_publikasi'] ?? 'Data Tidak Terbaca';
// }

//untuk ambil detail publikasi



//     public function getPublikasiById($id_sprp)
//     {
//         return $this->db->table('mst_nomorpub')->where('id_nomorpub', $id_sprp)->get()->getRowArray();
//     }

//     // // Method to insert publikasi data
//     // public function insertPublikasi($data)
//     // {
//     //     $this->db->table('mst_nomorpub')->insert($data);
//     //     return $this->db->insertID(); // Retrieve the last inserted ID
//     // }
    

//     // Method to update publikasi data
//     public function updatePublikasi($id_sprp, $data)
//     {
//         $this->db->table('mst_nomorpub')->where('id_nomorpub', $id_sprp)->update($data);

//     }

    
// // Insert into mst_nomorpub
// public function insertPublikasi($data)
// {
//     $this->db->table('mst_nomorpub')->insert($data);
// }

// // Insert into tbl_input_sprp
// public function insertInputSprp($data)
// {
//     $this->db->table('tbl_input_sprp')->insert($data);
// }

    

}
