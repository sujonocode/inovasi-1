<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Get the current URI
        $currentURI = service('uri')->getPath();

        // Exclude routes that do not require authentication
        $excludedRoutes = ['login', 'register']; // Add routes to exclude
        if (in_array($currentURI, $excludedRoutes)) {
            return;
        }

        // Redirect unauthenticated users to the login page
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must log in first to access this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No actions needed after the response
    }
}
