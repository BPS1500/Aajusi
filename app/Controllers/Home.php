<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Render view home.php
        return view('layouts/landing_layout', [
            'title' => 'Aajusi - Portal Publikasi BPS Provinsi Jambi'
        ]);
    }
}
