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
        return redirect()->to('/kelola/peranpengguna');
    }

    public function editUser($id)
    {
        $model = new ModelPengguna();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $data['judul'] = 'Kelola Pengguna';
        $data['subjudul'] = 'Edit Pengguna';

        return view('kelolamaster/edit_user', $data);
    }

    public function updateUser($id)
    {
        $model = new ModelPengguna();
        $data = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'nip_lama' => $this->request->getPost('nip_lama'),
            'roles' => json_encode(array_map('intval', $this->request->getPost('roles'))),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];
        $model->update($id, $data);
        return redirect()->to('/kelola/peranpengguna');
    }

    public function deleteUser($id)
    {
        $model = new ModelPengguna();
        $model->delete($id);
        return redirect()->to('/kelola/peranpengguna')->with('message', 'User deleted successfully.');
    }


}

?>
