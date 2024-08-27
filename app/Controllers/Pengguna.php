<?php

namespace App\Controllers;

use App\Models\ModelPengguna;

class Pengguna extends BaseController
{
    public function index()
    {
        $model = new ModelPengguna();
        $users = $model->findAll();

        // Fetch role names
        foreach ($users as &$user) {
            $roleIds = json_decode($user['roles'], true);
            $user['roles'] = $model->getRoleNames($roleIds);
        }

        $data['users'] = $users;
        $data['judul'] = 'Kelola Pengguna';
        $data['subjudul'] = 'Daftar Pengguna';

        return view('kelolamaster/user', $data);
    }

    public function createUser()
    {
        $data['judul'] = 'Kelola Pengguna';
        $data['subjudul'] = 'Tambah Pengguna';

        return view('kelolamaster/create_user', $data);
    }

    public function storeUser()
    {
        $model = new ModelPengguna();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'nip_lama' => $this->request->getPost('nip_lama'),
            'roles' => json_encode(array_map('intval', $this->request->getPost('roles'))),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];
        $model->insert($data);
        return redirect()->to('');
    }
}

?>
