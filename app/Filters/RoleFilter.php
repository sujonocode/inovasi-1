<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        if ($arguments && !in_array($session->get('role'), $arguments)) {
            // Redirect to custom unauthorized page
            return redirect()->to('/unauthorized')->with(
                'error',
                'Access denied: insufficient privileges.'
            );
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No actions required here.
    }
}
