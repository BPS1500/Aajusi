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
        return view('sprp/index', $data);
    }

    public function create()
    {
        return view('sprp/create');
    }

    public function store()
    {
        $model = new SprpModel();
        $data = [
            'kodewilayah' => $this->request->getPost('kodewilayah'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'ISBN' => $this->request->getPost('ISBN'),
            'jml_arab' => $this->request->getPost('jml_arab'),
            'jml_romawi' => $this->request->getPost('jml_romawi'),
            'kerjasama_instansi' => $this->request->getPost('kerjasama_instansi'),
            'id_pembuatcover' => $this->request->getPost('id_pembuatcover'),
            'orientasi' => $this->request->getPost('orientasi'),
            'diterbitkanuntuk' => $this->request->getPost('diterbitkanuntuk'),
            'nama_ukuran' => $this->request->getPost('nama_ukuran'),
            'id_ukuran' => $this->request->getPost('id_ukuran'),
        ];
        $model->insert($data);
        return redirect()->to('/sprp');
    }

    public function edit($id_sprp)
    {
        $model = new SprpModel();
        $data['sprp'] = $model->find($id_sprp);
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
            'id_pembuatcover' => $this->request->getPost('id_pembuatcover'),
            'orientasi' => $this->request->getPost('orientasi'),
            'diterbitkanuntuk' => $this->request->getPost('diterbitkanuntuk'),
            'nama_ukuran' => $this->request->getPost('nama_ukuran'),
            'id_ukuran' => $this->request->getPost('id_ukuran'),
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
}
