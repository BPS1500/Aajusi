<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenyusun extends Model
{

    protected $table = 'tbl_penyusun';
    protected $useTimeStamps = true;
    protected $allowedFields = ['id_penyusun', 'nama_penyusun', 'username', 'password', 'level', 'foto'];

    public function getPenyusun($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->where(['id_penyusun' => $id])->first();
        }
    }

    public function add($data)
    {
        return $this->insert($data);
    }

    public function updatePenyusun($id, $data)
    {

        return $this->db->table('tbl_penyusun')->update($data, array('id_penyusun' => $id));
    }

    public function deletePenyusun($id)
    {

        return $this->db->table('tbl_penyusun')->delete(array('id_penyusun' => $id));
    }
}
