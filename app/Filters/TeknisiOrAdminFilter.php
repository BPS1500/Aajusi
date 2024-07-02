<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class TeknisiOrAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!in_array('teknisi', $session->get('roles')) && !in_array('admin', $session->get('roles'))) {
            return redirect()->to('/dashboard')->with('msg', 'Access denied.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
