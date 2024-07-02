<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return redirect()->to('https://bpsjambi.online/sso/public/login?redirect_url=' . urlencode(base_url('auth/ssoCallback')));
    }

    public function ssoCallback()
    {
        $token = $this->request->getGet('token');
        $validationResult = $this->validateToken($token);

        if ($validationResult['status'] == '200') {
            $this->createUserSession($validationResult['user']);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('msg', 'SSO Login Failed');
        }
    }

    private function validateToken($token)
    {
        $secret_key = 'rahasianegara!';
        $url = 'https://bpsjambi.online/sso/public/auth/validate-token';

        $postData = http_build_query([
            'token' => $token,
            'secret_key' => $secret_key
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private function createUserSession($userData)
    {
        $session = session();
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        // Fetch user from DB
        $user = $userModel->where('nip_lama', $userData['nip_lama_user'])->first();

        if ($user) {
            $roles = json_decode($user['roles'], true);
        } else {
            $roles = [4]; // Default role ID 4
            $userModel->save([
                'username' => $userData['username'],
                'email' => $userData['email'],
                'nip_lama' => $userData['nip_lama_user'],
                'roles' => json_encode($roles),
                'fullname' => $userData['fullname'],
                'teams' => $userData['teams'],
                'is_active' => 1
            ]);
        }

        $defaultRole = $roles[0];
        $role_names = [];
        foreach ($roles as $role_id) {
            $role = $roleModel->find($role_id);
            $role_names[$role_id] = $role['role_name'];
        }

        $ses_data = [
            'id' => $user['id'] ?? $userModel->getInsertID(),
            'username' => $userData['username'],
            'full_name' => $userData['fullname'],
            'role' => $defaultRole,
            'roles' => $roles,
            'role_names' => $role_names,
            'role_name' => $role_names[$defaultRole],
            'nip_lama' => $userData['nip_lama_user'],
            'email' => $userData['email'],
            'teams' => $userData['teams'],
            'isLoggedIn' => TRUE
        ];
        $session->set($ses_data);
    }

    public function switchRole($role)
    {
        $session = session();
        $roles = $session->get('roles');
        $role_names = $session->get('role_names');

        if (in_array($role, $roles)) {
            $session->set('role', $role);
            $session->set('role_name', $role_names[$role]);
        }

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        // Destroy session SSO
        $url = 'https://bpsjambi.online/sso/public/logout?redirect_url=' . base_url();

        return redirect()->to($url)->with('urlcallback', base_url());
    }
}
