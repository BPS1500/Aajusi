<?php

namespace App\Controllers;

use App\Models\AksiLayananTIModel;
use App\Models\LayananTIModel;
use CodeIgniter\Controller;

class AksiLayananTIController extends Controller
{
    public function index()
    {
        $layananTIModel = new LayananTIModel();

        // Ambil NIP lama dari session
        $nip_lama_user = session()->get('nip_lama');

        // Ambil data pengajuan layanan TI yang diassign ke operator
        $data['pengajuan_layanan'] = $layananTIModel->where('nip_lama_teknisi', $nip_lama_user)->findAll();

        return view('aksi_layanan_ti/index', $data);
    }

    public function log($id_pengajuan)
    {
        $aksiLayananTIModel = new AksiLayananTIModel();
        $layananTIModel = new LayananTIModel();

        $data['aksi_layanan'] = $aksiLayananTIModel->where('id_pengajuan', $id_pengajuan)->findAll();
        $data['pengajuan'] = $layananTIModel->find($id_pengajuan);

        return view('aksi_layanan_ti/log', $data);
    }

    public function create($id_pengajuan)
    {
        $data['id_pengajuan'] = $id_pengajuan;
        return view('aksi_layanan_ti/create', $data);
    }

    public function store()
    {
        $aksiLayananTIModel = new AksiLayananTIModel();

        $data = [
            'id_pengajuan' => $this->request->getPost('id_pengajuan'),
            'deskripsi_aksi' => $this->request->getPost('deskripsi_aksi'),
            'biaya_penanganan' => $this->request->getPost('biaya_penanganan'),
            'kwitansi' => $this->request->getPost('kwitansi'),
            'dokumentasi' => $this->request->getPost('dokumentasi'),
            'tanggal_aksi' => $this->request->getPost('tanggal_aksi'),
        ];

        $aksiLayananTIModel->save($data);

        return redirect()->to('/aksi_layanan_ti/index');
    }

    public function updateStatus($id_pengajuan, $status)
    {
        $layananTIModel = new LayananTIModel();
        $layananTIModel->update($id_pengajuan, ['status' => $status]);

        return redirect()->to('/aksi_layanan_ti/index');
    }

    public function printTandaTerima($id_pengajuan)
    {
        $layananTIModel = new LayananTIModel();
        $data['pengajuan'] = $layananTIModel->find($id_pengajuan);

        return view('aksi_layanan_ti/tanda_terima', $data);
    }
}
