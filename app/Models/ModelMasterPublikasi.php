<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasterPublikasi extends Model
{
    protected $table = 'tbl_masterpublikasi b';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'id_jenispublikasi', 'jenis_publikasi', 'judul_publikasi_ind', 'judul_publikasi_eng', 'nama_penyusun', 'frekuensi_terbit', 'bahasa', 'no_issn', 'b.bahasa', 'c.frekuensi_terbit'];

    public function getMasterPublikasi($id = null)
    {
        $this->join('mst_bahasa a', 'b.bahasa=a.id_bahasa', 'left', false);
        $this->join('mst_frekuensi c', 'b.frekuensi_terbit=c.id_freq', 'left', false);
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->where(['a.id' => $id])->first();
        }
    }

    public function AllData()
    {
        return $this->db->table('tbl_masterpublikasi')
            ->orderBy('id', 'DESC')
            ->get()->getResultArray();
    }

    public function Add($data)
    {
        $this->db->table('tbl_masterpublikasi')->insert($data);
    }

    public function delete_masterpublikasi($id)
    {
        return $this->db->table('tbl_masterpublikasi')->delete(['id' => $id]);
    }

    public function getDataForUpdate($id)
    {
        return $this->db->table('tbl_masterpublikasi')->where('id', $id)->get()->getResultArray();
    }

    public function updateData($id, $data)
    {
        return $this->db->table('tbl_masterpublikasi')->update($data, ['id' => $id]);
    }

    public function countARC()
    {
        return count($this->db->table('tbl_masterpublikasi')
            ->where('id_jenispublikasi', 1)
            ->get()->getResultArray());
    }

    public function countNonARC()
    {
        return count($this->db->table('tbl_masterpublikasi')
            ->where('id_jenispublikasi', 2)
            ->get()->getResultArray());
    }

    public function getMstFrekuensi()
    {
        return $this->db->table('mst_frekuensi')->get()->getResultArray();
    }

    public function getMstBahasa()
    {
        return $this->db->table('mst_bahasa')->get()->getResultArray();
    }
}
