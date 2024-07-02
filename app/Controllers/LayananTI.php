<?php

namespace App\Controllers;

use App\Models\LayananTIModel;
use App\Models\JenisLayananModel;
use App\Models\PihakKetigaModel;
use App\Models\BMNModel;
use App\Models\UserModel; // Tambahkan ini untuk mengambil data user
use CodeIgniter\Controller;

class LayananTI extends Controller
{
    public function index()
    {
        $layananTIModel = new LayananTIModel();
        $jenisLayananModel = new JenisLayananModel();
        $bmnModel = new BMNModel();
        $userModel = new UserModel(); // Tambahkan ini untuk mengambil data user
        $pihakKetigaModel = new PihakKetigaModel(); //
        $data['pengajuan_layanan'] = $layananTIModel->findAll();
        $data['jenis_layanan'] = $jenisLayananModel->findAll();
        $data['bmn'] = $bmnModel->findAll();
        $data['users'] = $userModel->findAll(); // Tambahkan ini untuk mengambil data user
        $data['pihak_ketiga'] = $pihakKetigaModel->findAll();

        return view('layanan_ti/index', $data);
    }

    public function create()
    {
        $jenisLayananModel = new JenisLayananModel();
        $bmnModel = new BMNModel();

        $data['jenis_layanan'] = $jenisLayananModel->findAll();
        $data['bmn'] = $bmnModel->findAll();

        return view('layanan_ti/form_pengajuan', $data);
    }

    public function store()
    {
        $layananTIModel = new LayananTIModel();

        $data = [
            'nip_lama_user' => $this->request->getPost('nip_lama_user'),
            'jenis_layanan' => json_encode($this->request->getPost('jenis_layanan')),
            'no_bmn' => $this->request->getPost('no_bmn'),
            'deskripsi_keluhan_jaringan' => $this->request->getPost('deskripsi_keluhan_jaringan'),
            'deskripsi_keluhan_hardware' => $this->request->getPost('deskripsi_keluhan_hardware'),
            'deskripsi_keluhan_software' => $this->request->getPost('deskripsi_keluhan_software'),
            'deskripsi_keluhan_lainnya' => $this->request->getPost('deskripsi_keluhan_lainnya'),
            'keterangan_tambahan' => $this->request->getPost('keterangan_tambahan'),
            'status' => 'Diajukan',
        ];

        $layananTIModel->save($data);

        return redirect()->to('/layanan_ti');
    }

    #fungsi edit pengajuan
    public function edit($id)
    {
        $layananTIModel = new LayananTIModel();
        $jenisLayananModel = new JenisLayananModel();
        $bmnModel = new BMNModel();
        $userModel = new UserModel();

        $data['pengajuan'] = $layananTIModel->find($id);
        $data['jenis_layanan'] = $jenisLayananModel->findAll();
        $data['bmn'] = $bmnModel->findAll();
        $data['users'] = $userModel->findAll();

        return view('layanan_ti/form_edit_pengajuan', $data);
    }

    public function update($id)
    {
        $layananTIModel = new LayananTIModel();

        $data = [
            'nip_lama_user' => $this->request->getPost('nip_lama_user'),
            'jenis_layanan' => json_encode($this->request->getPost('jenis_layanan')),
            'no_bmn' => $this->request->getPost('no_bmn'),
            'deskripsi_keluhan_jaringan' => $this->request->getPost('deskripsi_keluhan_jaringan'),
            'deskripsi_keluhan_hardware' => $this->request->getPost('deskripsi_keluhan_hardware'),
            'deskripsi_keluhan_software' => $this->request->getPost('deskripsi_keluhan_software'),
            'deskripsi_keluhan_lainnya' => $this->request->getPost('deskripsi_keluhan_lainnya'),
            'keterangan_tambahan' => $this->request->getPost('keterangan_tambahan'),
            'status' => $this->request->getPost('status'),
        ];

        $layananTIModel->update($id, $data);

        return redirect()->to('/layanan_ti');
    }

    ##fungsi assign petugas
    public function assign($id)
    {
        $layananTIModel = new LayananTIModel();
        $jenisLayananModel = new JenisLayananModel();
        $bmnModel = new BMNModel();
        $userModel = new UserModel();
        $pihakKetigaModel = new PihakKetigaModel();

        $data['pengajuan'] = $layananTIModel->find($id);
        $data['jenis_layanan'] = $jenisLayananModel->findAll();
        $data['bmn'] = $bmnModel->find($data['pengajuan']['no_bmn']);
        $data['users'] = $userModel->findAll();
        $data['pihak_ketiga'] = $pihakKetigaModel->findAll();

        return view('layanan_ti/form_assign_petugas', $data);
    }

    public function assign_store($id)
    {
        $layananTIModel = new LayananTIModel();

        $pihakKetigaModel = new PihakKetigaModel();
        $nama_pihak_ketiga = $this->request->getPost('nama_pihak_ketiga');
        $id_pihak_ketiga = $this->request->getPost('id_pihak_ketiga');

        if (empty($id_pihak_ketiga) && !empty($nama_pihak_ketiga)) {
            $pihakKetigaModel->save(['nama' => $nama_pihak_ketiga]);
            $id_pihak_ketiga = $pihakKetigaModel->insertID();
        }

        $data = [
            'nip_lama_teknisi' => $this->request->getPost('nip_lama_teknisi'),
            'id_pihak_ketiga' => $id_pihak_ketiga,
            'status' => 'Assigned',
        ];

        $layananTIModel->update($id, $data);

        return redirect()->to('/layanan_ti');
    }
    ##fungsi cetak tanda terima
    public function print($id)
    {
        $layananTIModel = new LayananTIModel();
        $jenisLayananModel = new JenisLayananModel();
        $bmnModel = new BMNModel();
        $userModel = new UserModel();

        $data['pengajuan'] = $layananTIModel->find($id);
        $data['jenis_layanan'] = $jenisLayananModel->findAll();
        $data['bmn'] = $bmnModel->findAll();
        $data['users'] = $userModel->findAll();

        return view('layanan_ti/print_pengajuan', $data);
    }
}
