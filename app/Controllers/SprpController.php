<?php

namespace App\Controllers;

use App\Models\SprpModel;
use CodeIgniter\Controller;

class SprpController extends Controller
{
    public function index()
    {
        $model = new SprpModel();
        $data['sprps'] = $model->findAll();
    
        // Iterasi melalui setiap item untuk menambahkan nama kategori, pembuat cover, dan diterbitkan untuk
        foreach ($data['sprps'] as &$sprp) {
            // Mengambil nama kategori berdasarkan id_kategori
            $sprp['kategori_pub'] = $model->getKategoriName($sprp['id_kategori']) ?? 'Unknown';
    
            // Mengambil nama pembuat cover berdasarkan id_cover
            $sprp['pembuat_cover'] = $model->getCoverName($sprp['id_cover']) ?? 'Unknown';
            $sprp['orientasi'] = $model->getOrientasiName($sprp['id_orientasi']) ?? 'Unknown';
            $sprp['diterbitkanuntuk'] = $model->getTerbitName($sprp['id_diterbit']) ?? 'Unknown';
            $sprp['nama_ukuran'] = $model->getUkuranName($sprp['id_ukuran']) ?? 'Unknown';
            $sprp['nama_wilayah'] = $model->getWilayahName($sprp['kodewilayah']) ?? 'Unknown';
            // $sprp['jenis_publikasi'] = $model->getPublikasiName($sprp['id_jenispublikasi']) ?? 'Unknown';
          


            $publikasiDetails = $model->getPublikasiDetails($sprp['id']);
            $sprp['katalog'] = $publikasiDetails['katalog'] ?? 'Unknown';
            $sprp['judul_publikasi_ind'] = $publikasiDetails['judul_publikasi_ind'] ?? 'Unknown';
            $sprp['judul_publikasi_eng'] = $publikasiDetails['judul_publikasi_eng'] ?? 'Unknown';
            $sprp['no_issn'] = $publikasiDetails['no_issn'] ?? 'Unknown';
            $sprp['jenis_publikasi'] = $publikasiDetails['id_jenispublikasi'] ?? 'Unknown';
            


            if ($sprp['jenis_publikasi'] == 1) {
                $sprp['jenis_publikasi'] = 'ARC';
            } elseif ($sprp['jenis_publikasi'] == 2) {
                $sprp['jenis_publikasi'] = 'Non ARC';
            } else {
                $sprp['jenis_publikasi'] = 'Unknown';
            }
            
       
        }
    
        // Mengembalikan tampilan dengan data yang telah diproses
        return view('sprp/index', $data);
    }
    
    public function create()
    {
        $model = new SprpModel();
        $datawilayah = $model->getWilayah();
        $datakategori = $model->getKategori();
        $datajenispublikasi = $model->getJenispublikasi();
        $datacover = $model->getCover();
        $datapublikasi = $model->getPublikasi();
        $dataterbit = $model->getTerbit();
        $dataukuran = $model->getUkuran();
        $dataorientasi = $model->getOrientasi();

        return view('sprp/create',[
        'datawilayah' => $model->getWilayah(),
        'datakategori'=> $model->getKategori(),
        'datajenispublikasi' => $model->getJenispublikasi(),
        'datacover' => $model->getCover(),
        'datapublikasi' => $model->getPublikasi(),
        'dataterbit' => $model->getTerbit(),
        'dataukuran'=> $model-> getUkuran(),
        'dataorientasi' => $model->getOrientasi()
        ]);

        
    }

    public function store()
{
    $model = new SprpModel();
    
    // Get input data
    $data = [
        'kodewilayah' => $this->request->getPost('kodewilayah'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'ISBN' => $this->request->getPost('ISBN'),
        'jml_arab' => $this->request->getPost('jml_arab'),
        'jml_romawi' => $this->request->getPost('jml_romawi'),
        'kerjasama_instansi' => $this->request->getPost('kerjasama_instansi'),
        'id_cover' => $this->request->getPost('id_cover'),
        'id_orientasi' => $this->request->getPost('id_orientasi'),
        'id_diterbit' => $this->request->getPost('id_diterbit'),
        'id_ukuran' => $this->request->getPost('id_ukuran'),
        'id'=> $this->request->getPost('id'),
    ];

    // Validation check
    if (empty($data['kodewilayah']) || empty($data['id_kategori']) || empty($data['id_cover']) || empty($data['id_orientasi']) || empty($data['id_diterbit']) || empty($data['id_ukuran'])) {
        return redirect()->back()->withInput()->with('error', 'Semua kolom yang ditandai dengan * wajib diisi.');
    }
    
    $model->insert($data);

    return redirect()->to('/sprp');
}


    public function edit($id_sprp)
    {
        $model = new SprpModel();
        $data['sprp'] = $model->find($id_sprp);
        $data['datawilayah'] = $model->getWilayah();
        $data['datapublikasi'] = $model->getPublikasi();
        $data['datakategori'] = $model->getKategori();
        $data['datajenispublikasi'] = $model->getJenispublikasi();
        $data['datacover'] = $model->getCover();
        $data['dataterbit'] = $model->getTerbit();
        $data['dataukuran'] = $model->getUkuran();
        $data['dataorientasi'] = $model->getOrientasi();
        
        return view('sprp/edit', $data);
    }
    
    public function update($id_sprp)
    {
        $model = new SprpModel();
        $data = [
            'kodewilayah' => $this->request->getPost('kodewilayah'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'ISBN' => $this->request->getPost('ISBN'),
            'jml_arab' => $this->request->getPost('jml_arab'),
            'jml_romawi' => $this->request->getPost('jml_romawi'),
            'kerjasama_instansi' => $this->request->getPost('kerjasama_instansi'),
            'id_cover' => $this->request->getPost('id_cover'),
            'id_orientasi' => $this->request->getPost('id_orientasi'),
            'id_diterbit' => $this->request->getPost('id_diterbit'),
            'id_ukuran' => $this->request->getPost('id_ukuran')
        ];
        $model->update($id_sprp, $data);
        return redirect()->to('/sprp');
    }

    public function delete($id_sprp)
    {
        $model = new SprpModel();
        $model->delete($id_sprp);
        return redirect()->to('/sprp');
    }   


    public function get_details($id_sprp)
    {
        $model = new SprpModel();
        $sprp = $model->find($id_sprp);

        if ($sprp) {
            // Populate additional data
            $sprp['kategori_pub'] = $model->getKategoriName($sprp['id_kategori']) ?? 'Unknown';
            $sprp['pembuat_cover'] = $model->getCoverName($sprp['id_cover']) ?? 'Unknown';
            $sprp['orientasi'] = $model->getOrientasiName($sprp['id_orientasi']) ?? 'Unknown';
            $sprp['diterbitkanuntuk'] = $model->getTerbitName($sprp['id_diterbit']) ?? 'Unknown';
            $sprp['nama_ukuran'] = $model->getUkuranName($sprp['id_ukuran']) ?? 'Unknown';
            $sprp['nama_wilayah'] = $model->getWilayahName($sprp['kodewilayah']) ?? 'Unknown';

            $publikasiDetails = $model->getPublikasiDetails($sprp['id']);
            $sprp['katalog'] = $publikasiDetails['katalog'] ?? 'Unknown';
            $sprp['judul_publikasi_ind'] = $publikasiDetails['judul_publikasi_ind'] ?? 'Unknown';
            $sprp['judul_publikasi_eng'] = $publikasiDetails['judul_publikasi_eng'] ?? 'Unknown';
            $sprp['no_issn'] = $publikasiDetails['no_issn'] ?? 'Unknown';
            $sprp['jenis_publikasi'] = $publikasiDetails['id_jenispublikasi'] ?? 'Unknown';

            if ($sprp['jenis_publikasi'] == 1) {
                $sprp['jenis_publikasi'] = 'ARC';
            } elseif ($sprp['jenis_publikasi'] == 2) {
                $sprp['jenis_publikasi'] = 'Non ARC';
            } else {
                $sprp['jenis_publikasi'] = 'Unknown';
            }

            return $this->response->setJSON($sprp);
        } else {
            return $this->response->setJSON(['error' => 'Data not found']);
        }
    }   

    public function store_nomor_publikasi()
{
    $id_sprp = $this->request->getPost('id');
    $nomor_publikasi = $this->request->getPost('no_publikasi');

    $data = [
        'nomor_publikasi' => $nomor_publikasi
    ];

    $sprpModel = new SprpModel();

    if ($sprpModel->update($id_sprp, $data)) {
        return $this->response->setJSON(['success' => true, 'message' => 'Nomor Publikasi berhasil disimpan.']);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan Nomor Publikasi.']);
    }
}
    
}
