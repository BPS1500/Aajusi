<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasterPublikasi;

class MasterPublikasi extends BaseController
{
    public function index()
    {
        $model = new ModelMasterPublikasi();
        $data['publikasi'] = $model->getMasterPublikasi(); 
        $data['frekuensi'] = $model->getMstFrekuensi();   
        $data['bahasa'] = $model->getMstBahasa();
        $data['judul'] = 'Master Publikasi';
        $data['subjudul'] = 'Daftar Publikasi';

        return view('kelolamaster/master_publikasi', $data);
    }

    public function delete($id)
    {
        $model = new ModelMasterPublikasi();
        $model->delete_masterpublikasi($id);

        return redirect()->to(base_url('kelola/masterpublikasi'));
    }

    public function tambah()
    {
        $model = new ModelMasterPublikasi();
        $data = [
            'id_jenispublikasi' => $this->request->getPost('id_jenispublikasi'),
            'judul_publikasi_ind' => $this->request->getPost('judul_publikasi_ind'),
            'judul_publikasi_eng' => $this->request->getPost('judul_publikasi_eng'),
            'frekuensi_terbit' => $this->request->getPost('frekuensi_terbit'),
            'bahasa' => $this->request->getPost('bahasa'),
            'no_issn' => $this->request->getPost('no_issn')
        ];
        $model->Add($data);

        return redirect()->to(base_url('kelola/masterpublikasi'));
    }

    public function edit($id)
    {
        $model = new ModelMasterPublikasi();
        $data = [
            'judul_publikasi_ind' => $this->request->getPost('judul_publikasi_ind'),
            'judul_publikasi_eng' => $this->request->getPost('judul_publikasi_eng'),
            'frekuensi_terbit' => $this->request->getPost('frekuensi_terbit'),
            'bahasa' => $this->request->getPost('bahasa'),
            'no_issn' => $this->request->getPost('no_issn')
        ];
        $model->updateData($id, $data);

        return redirect()->to(base_url('kelola/masterpublikasi'));
    }
}
