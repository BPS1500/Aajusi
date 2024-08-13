<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMasterPublikasi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            'no_issn' => $this->request->getPost('no_issn'),
            'katalog' => $this->request->getPost('katalog')
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
            'no_issn' => $this->request->getPost('no_issn'),
            'katalog' => $this->request->getPost('katalog')
        ];
        $model->updateData($id, $data);

        return redirect()->to(base_url('kelola/masterpublikasi'));
    }

    public function unggahPublikasi()
    {
        $validation = \Config\Services::validation();
    
        if (!$this->validate([
            'file_upload' => 'uploaded[file_upload]|max_size[file_upload,2048]|ext_in[file_upload,xls,xlsx]'
        ])) {
            // On validation failure
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'File tidak valid atau tidak sesuai format yang ditentukan.'
            ]);
        }
    
        $file = $this->request->getFile('file_upload');
        $newName = "master_publikasi_" . date('Y-m-d_H_i_s') . ".xlsx";
        $targetPath = FCPATH . 'assets/data/master_publikasi/';
        $file->move($targetPath, $newName);
    
        $filePath = $targetPath . $newName;
    
        // Load spreadsheet from file
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);
    
        // Validate the template format
        if ($data[3]['A'] != "1" && $data[3]['A'] != "2") {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Template yang diupload salah.'
            ]);
        }
    
        // Process and save each row
        foreach (array_slice($data, 2) as $row) { // Start from row 3
            if (!empty($row['B'])) { // Assuming Judul Publikasi (Indonesia) is mandatory
                $rowData = [
                    'id_jenispublikasi' => $row['A'],
                    'judul_publikasi_ind' => $row['B'],
                    'judul_publikasi_eng' => $row['C'],
                    'nama_penyusun' => $row['D'],
                    'frekuensi_terbit' => $row['E'],
                    'bahasa' => $row['F'],
                    'no_issn' => $row['G'],
                    'katalog' => $row['H'],
                    'created_at' => date('Y-m-d H:i:s'),
                ];                
                $this->saveToMasterPublikasi($rowData);
            }
        }
    
        // On success
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'File berhasil diunggah.'
        ]);
    }
    
    
    private function saveToMasterPublikasi($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_masterpublikasi');
    
        // Insert the data into the tbl_masterpublikasi table
        $builder->insert($data);
    }
    

}