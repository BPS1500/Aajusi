<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPublikasi;
use PhpParser\Node\Stmt\Label;

class Publikasi extends BaseController
{
    protected $ModelPublikasi;
    
    public function __construct()
    {
        helper('form');
        $this->ModelPublikasi = new \App\Models\ModelPublikasi();
        // $this->session = \Config\Services::session();
    }
    
    public function index()
    {
        $data = [
            'judul' => 'Publikasi',
            'page' => 'v_publikasi',
            'Publikasi' => $this->ModelPublikasi->AllData(),
            'dataARC' => $this->ModelPublikasi->countARC(),
        ];

        //dd($data);
        return view('pengajuan_publikasi/index', $data);
    }

    public function dashboard()
    {
        $datadash = $this->ModelPublikasi->dashData();
        $statuspublikasi = $this->ModelPublikasi->getMstStatusReview();
        $data = [
            'menu' => 'Dasbor',
            'judul' => 'Dasbor Penyusun',
            'page' => 'v_penyusun',
            'dataDashboard' => $datadash,
            'status' => $statuspublikasi
        ];
        //dd($data);
        return view('dashboard', $data);
    }

    public function Ajupublikasi()
    {
        $data = [
            'judul' => 'Pengajuan Publikasi',
            'page' => 'v_ajupublikasi',
            'Ajupublikasi' => $this->ModelPublikasi->AllData(),
            'jenispublikasi' => $this->ModelPublikasi->AllJenispublikasi(),
            'fungsi' => $this->ModelPublikasi->AllFungsi(),
        ];
        return view('pengajuan_publikasi/ajupublikasi', $data);
    }

    public function Judulpublikasi($id_jenispublikasi)
    {
        $judulpublikasi = $this->ModelPublikasi->AllJudulpublikasi($id_jenispublikasi);
        echo '<option value="">--Pilih Judul Publikasi--</option>';
        foreach ($judulpublikasi as $key => $jp) {
            echo "<option value=" . $jp['id'] . ">" . $jp['judul_publikasi_ind'] . "</option>";
        }
    }

    public function LihatKomentar($id_publikasi)
    {
        $dataKomentar = $this->ModelPublikasi->OneDataKomenter($id_publikasi);
        $data = [
            'judul' => 'Komentar',
            'page' => 'v_komentar_penyusun',
            'Komentar' => $dataKomentar,
            'id_publikasi' => $id_publikasi,
        ];
    
        return view('pengajuan_publikasi/komentar_penyusun', $data);
    }
    
    public function InsertData()
    {
        if ($this->validate([
            'id_jenispublikasi' => [
                'label' => 'Jenis Publikasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih!!'
                ]
            ],
            'id_judulpublikasi' => [
                'label' => 'Judul Publikasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih!!'
                ]
            ],
            'id_fungsi' => [
                'label' => 'Fungsi Pengusul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih!!'
                ]
            ],
            'nama_penyusun' => [
                'label' => 'Nama Penyusun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih!!'
                ]
            ],
            'link_publikasi' => [
                'label' => 'Link Publikasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih!!'
                ]
            ],
        ])) {
            //Jika Valid
            $data = [
                'id_user_upload' => $this->request->getPost('id_user_upload'),
                'id_jenispublikasi' => $this->request->getPost('id_jenispublikasi'),
                'id_judulpublikasi' => $this->request->getPost('id_judulpublikasi'),
                'id_fungsi' => $this->request->getPost('id_fungsi'),
                'nama_penyusun' => $this->request->getPost('nama_penyusun'),
                'link_publikasi' => $this->request->getPost('link_publikasi'),
                'link_spsnrkf' => $this->request->getPost('link_spsnrkf'),
                'link_spsnres2' => $this->request->getPost('link_spsnres2'),
                'nip_lama' => $this->request->getPost('nip_lama'),  // Save nip_lama
                'flag' => 5,
            ];
            $this->ModelPublikasi->InsertData($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan!');
            return redirect()->to(base_url('Publikasi'));
        } else {
            //Jika Tidak Valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Publikasi/Ajupublikasi'))->withInput('validation', \Config\Services::validation());
        }
    }


    public function getLink()
    {
        $id = $this->request->getPost('id');
        $dataLink = $this->ModelPublikasi->getDataLink($id);
        echo $dataLink[0]['link_publikasi'];
    }

    public function setLink()
    {
        $id = $this->request->getPost('id');

        $dataLink = $this->request->getPost('link');

        $data = [
            'link_publikasi' => $dataLink,
            'flag' => 1,
            'status' => 1,
        ];

        $this->ModelPublikasi->setDataLink($id, $data);
        return redirect()->to(base_url('Publikasi'));
    }

    public function getDataEdit()
    {
        $getData = $this->request->getPost('id');
        $data = $this->ModelPublikasi->getKomentar($getData);

        echo json_encode($data);
    }

    public function editKomentar()
    {
        $id_komentar = $this->request->getPost('id_komentar');
        $catatan = $this->request->getPost('catatan');
        
        $data = [
            'catatan' => $catatan,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $result = $this->ModelPublikasi->updateKomentar($id_komentar, $data);
        
        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function AddKomentar()
    {
        $pemeriksa = session()->get('full_name');

        $data = [
            'catatan' => $this->request->getPost('catatan'),
            'id_publikasi' => $this->request->getPost('id_publikasi'),
            'pemeriksa' => $pemeriksa,
            'selesai' => 0, // 0 sebagai komentar baru
            'tgl_komen_admin' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        $this->ModelPublikasi->addCatatanPemeriksa($data);
        return redirect()->to(base_url('Publikasi/LihatKomentar/' . $data['id_publikasi']))->with('success', 'Komentar berhasil ditambahkan');
    }

    public function getStatusOptions()
    {
        $model = new \App\Models\ModelPublikasi();
        $statusOptions = $model->getMstStatusReview();
        
        echo json_encode($statusOptions);
    }

    public function updateStatus()
    {
        $id_publikasi = $this->request->getPost('id_publikasi');
        $status_review = $this->request->getPost('status_review');
        
        $result = $this->ModelPublikasi->updateStatus($id_publikasi, ['flag' => $status_review]);
        
        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function deleteKomentar($id_komentar)
    {
        if (session()->get('role') == '1') {
            $this->ModelPublikasi->deleteKomentar($id_komentar);
            session()->setFlashdata('success', 'Comment deleted successfully.');
        } else {
            session()->setFlashdata('error', 'You do not have permission to delete this comment.');
        }
    
        return redirect()->back();
    }    

    public function deletePublikasi($id_publikasi)
    {
        if (session()->get('role') == 1 || session()->get('role') == 4) {
            $result = $this->ModelPublikasi->deletePublikasi($id_publikasi);
            if ($result) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function updateLink()
    {
        try {
            if (session()->get('role') != 4) {
                return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
            }

            $id = $this->request->getPost('id');
            $type = $this->request->getPost('type');
            $newLink = $this->request->getPost('new_link');

            $columnName = 'link_publikasi';
            if ($type === 'spsnrkf') {
                $columnName = 'link_spsnrkf';
            } elseif ($type === 'spsnres2') {
                $columnName = 'link_spsnres2';
            }

            $result = $this->ModelPublikasi->updateLink($id, $columnName, $newLink);

            if ($result) {
                return $this->response->setJSON(['success' => true]);
            } else {
                log_message('error', 'Failed to update link. ID: ' . $id . ', Column: ' . $columnName . ', New Link: ' . $newLink);
                return $this->response->setJSON(['success' => false, 'message' => 'Database update failed']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception in updateLink: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    public function addReply()
    {
        $id_komentar = $this->request->getPost('id_komentar');
        $catatan = $this->request->getPost('catatan');
        $pemeriksa = session()->get('full_name');

        $data = [
            'id_komentar' => $id_komentar,
            'catatan' => $catatan,
            'pemeriksa' => $pemeriksa,
            'tgl_reply' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->ModelPublikasi->addReply($data);

        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function getReplies()
    {
        $id_komentar = $this->request->getGet('id_komentar');
        $replies = $this->ModelPublikasi->getReplies($id_komentar);

        $html = '';
        foreach ($replies as $reply) {
            $html .= '<div class="reply">';
            $html .= '<p><strong>' . $reply['pemeriksa'] . '</strong> (' . $reply['tgl_reply'] . ')</p>';
            $html .= '<p>' . $reply['catatan'] . '</p>';
            $html .= '</div>';
        }

        return $this->response->setBody($html);
    }

}
