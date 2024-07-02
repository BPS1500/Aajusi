<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}
