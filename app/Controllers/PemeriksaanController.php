<?php

namespace App\Controllers;

use App\Models\SprpModel;
use CodeIgniter\Controller;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $model = new SprpModel();
        $data['sprps'] = $model->findAll();

        // Iterate through each item to add category name, cover maker, and published for names
        foreach ($data['sprps'] as &$sprp) {
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
        }

        // Return the processed data to the view
        return view('pemeriksaan/index', $data);
    }

    public function store()
    {
        $model = new SprpModel();
        
        // Validate input data from the modal
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kodewilayah' => 'required',
            'id_kategori' => 'required',
            'ISBN' => 'required',
            'jml_arab' => 'required|numeric',
            'jml_romawi' => 'required|numeric',
            'kerjasama_instansi' => 'required',
            'id_cover' => 'required',
            'id_orientasi' => 'required',
            'id_diterbit' => 'required',
            'id_ukuran' => 'required',
            'id' => 'required',
            'nomor_publikasi' => 'required' // Add validation rule for nomor_publikasi
        ]);

        if (!$this->validate($validation->getRules())) {
            // Return to the form with validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // If validation passes, gather the data
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
            'id' => $this->request->getPost('id'),
            'nomor_publikasi' => $this->request->getPost('nomor_publikasi') // Add nomor_publikasi to the data array
        ];

        // Insert data into the table
        $model->insert($data);

        // Redirect to the index page
        return redirect()->to('/pemeriksaan');
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

        return view('pemeriksaan/create',[
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
        
        return view('pemeriksaan/edit', $data);
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
        return redirect()->to('/pemeriksaan');
    }

    public function delete($id_sprp)
    {
        $model = new SprpModel();
        $model->delete($id_sprp);
        return redirect()->to('/pemeriksaan');
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
            // $sprp['nomor_publikasi'] = $model->getNomorPub($sprp['id_nomorpub']) ?? 'Unknown';
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

    private function saveToSprp($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_input_sprp');
    
        $builder->insert($data);
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

  
  






    

