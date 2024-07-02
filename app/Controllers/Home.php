<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Render view home.php
        return view('home', [
            'title' => 'SiNanTI - Sistem Layanan TI'
        ]);
    }
}
