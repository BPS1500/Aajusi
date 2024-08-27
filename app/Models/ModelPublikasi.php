<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPublikasi extends Model
{

    protected $table = 'tbl_masterpublikasi a';
    protected $useTimeStamps = true;
    protected $allowedFields = ['id_publikasi', 'id_judulpublikasi', 'id_jenispublikasi', 'id_fungsi', 'nama_penyusun', 'link_publikasi', 'catatan', 'pemeriksa', 'status', 'created_at', 'updated_at', 'deleted_at'];


    public function getPublikasi($id = null)
    {
        $this->join('tbl_jenispublikasi b', 'a.id_jenispublikasi=b.id_jenis_publikasi', 'left', false);
        $this->join('tbl_masterpublikasi c', 'a.id_judulpublikasi=c.id', 'left', false);
        // $this->join('tbl_jenispublikasi d', 'd.id_fungsi=d.id_fungsi', 'left', false);
        $this->join('mst_status_review e', 'a.flag=e.id');
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getMstStatusReview($id=null){
        if($id==null){
            return $this->db->table('mst_status_review')->Get()->getResultArray();
        } else{
            return $this->db->table('mst_status_review')->where(['id'=>$id])->Get()->getResultArray();
        }
    }

    public function AllData()
    {
        return $this->db->table('tbl_publikasi')
            ->select('tbl_publikasi.*, tbl_jenispublikasi.*, tbl_masterpublikasi.judul_publikasi_ind, tbl_fungsi.nama_fungsi, mst_status_review.status_review, mst_status_review.bgcolor')
            ->join('tbl_jenispublikasi', 'tbl_jenispublikasi.id_jenispublikasi = tbl_publikasi.id_jenispublikasi', 'left')
            ->join('tbl_masterpublikasi', 'tbl_masterpublikasi.id = tbl_publikasi.id_judulpublikasi', 'left')
            ->join('tbl_fungsi', 'tbl_fungsi.id_fungsi = tbl_publikasi.id_fungsi', 'left')
            ->join('mst_status_review', 'mst_status_review.id = tbl_publikasi.flag', 'left')
            ->get()->getResultArray();
    }

    public function AllJenispublikasi()
    {
        return $this->db->table('tbl_jenispublikasi')
            ->get()->getResultArray();
    }

    public function countARC()
    {
        return count($this->db->table('tbl_publikasi')
            ->where('id_jenispublikasi', 1)
            ->get()->getResultArray());
    }

    public function countNonARC()
    {
        return count($this->db->table('tbl_publikasi')
            ->where('id_jenispublikasi', 2)
            -> get()->getResultArray());
    }

    public function AllJudulpublikasi($id_jenispublikasi)
    {
        return $this->db->table('tbl_masterpublikasi')
            ->where('id_jenispublikasi', $id_jenispublikasi)
            ->get()->getResultArray();
    }
    public function AllFungsi()
    {
        return $this->db->table('tbl_fungsi')
            ->get()->getResultArray();
    }


    public function InsertData($data)
    {
        $this->db->table('tbl_publikasi')->insert($data);
    }

    public function addCatatanPemeriksa($data)
    {
        return $this->db->table('tbl_komentar')->insert($data);
    }

    // function get data komentar :
    public function OneDataKomenter($id_publikasi)
    {
        $where = "id_publikasi = '$id_publikasi'";
        return $this->db->table('tbl_komentar')->where($where)->get()->getResultArray();
    }

    public function Komentar_Selesai($data, $id_komentar)
    {
        return $this->db->table('tbl_komentar')->update($data, array('id_komentar' => $id_komentar));
    }

    public function getKomentar($id)
    {
        $where = "id_komentar = '$id'";
        return $this->db->table('tbl_komentar')->where($where)->get()->getFirstRow();
    }

    // public function updateKomentar($id, $data)
    // {
    //     return $this->db->table('tbl_komentar')->update($data, array('id_komentar' => $id));
    // }
    
    public function updateKomentar($id_komentar, $data)
    {
        return $this->db->table('tbl_komentar')->where('id_komentar', $id_komentar)->update($data);
    }
    

    public function updateStatus($id, $data)
    {
        return $this->db->table('tbl_publikasi')->update($data, array('id_publikasi' => $id));
    }

    public function getDataLink($id_publikasi)
    {
        return $this->db->table('tbl_publikasi')->where('id_publikasi', $id_publikasi)->get()->getResultArray();
    }

    public function setDataLink($id, $data)
    {
        return $this->db->table('tbl_publikasi')->update($data, array('id_publikasi' => $id));
    }

    public function delete_reviewpublikasi($id_publikasi)
    {
        return $this->db->table('tbl_publikasi')->delete(array('id_publikasi' => $id_publikasi));
    }


    public function countPenyusun()
    {
        return count($this->db->table('tbl_penyusun')
            ->get()->getResultArray());
    }

    public function getPublikasibyStatus($status)
    {
        return $this->db->table('tbl_publikasi')->where('flag',$status)->get()->getResultArray();

    }

    public function getPublikasibyJenisStatus($jenis, $status)
    {
    //    $this->db->where('id_jenispublikasi',$jenis); 
        return $this->db->table('tbl_publikasi')->where(array('flag'=>$status,'id_jenispublikasi'=>$jenis))->get()->getResultArray();

    }

    public function dashData()
    {
        $arcstatus = array();

        $masterArc =  count($this->db->table('tbl_masterpublikasi')
        ->where('id_jenispublikasi', 1)
        ->get()->getResultArray());

        $masterNonArc = count($this->db->table('tbl_masterpublikasi')
        ->where('id_jenispublikasi', 2)
        ->get()->getResultArray());
        
        $arc = $this->countARC();
        $nonArc = $this->countNonARC();
        for($i=1;$i<=4;$i++){
            $arcstatus[$i]= count($this->getPublikasibyJenisStatus(1,$i));
            $nonarcstatus[$i]= count($this->getPublikasibyJenisStatus(2,$i));
        }
        // $arcstatus[0]= $this->getPublikasibyJenisStatus(1,1);

        $data= array('masterarc'=>$masterArc,'masternonarc'=>$masterNonArc,'arcstatus'=>$arcstatus,'nonarcstatus'=>$nonarcstatus,'arc'=>$arc,'nonarc'=>$nonArc);
        return $data;
    }

    public function deleteKomentar($id_komentar)
    {
        $this->db->table('tbl_komentar')->delete(['id_komentar' => $id_komentar]);
    }
    
    public function deletePublikasi($id_publikasi)
    {
        return $this->db->table('tbl_publikasi')->delete(['id_publikasi' => $id_publikasi]);
    }

    public function updateLink($id, $columnName, $newLink)
    {
        try {
            $result = $this->db->table('tbl_publikasi')
                ->where('id_publikasi', $id)
                ->update([$columnName => $newLink]);
    
            if ($result === false) {
                log_message('error', 'Database error in updateLink: ' . $this->db->error()['message']);
            }
    
            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Exception in updateLink: ' . $e->getMessage());
            return false;
        }
    }

    public function addReplyKomentar($data)
    {
        return $this->db->table('tbl_replykomentar')->insert($data);
    }
    
    public function getRepliesByKomentar($id_komentar)
    {
        return $this->db->table('tbl_replykomentar')
            ->where('id_komentar', $id_komentar)
            ->get()
            ->getResultArray();
    }
    
}
