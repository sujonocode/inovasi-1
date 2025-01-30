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

        // Check if the user is logged in
        if ($session->has('isLoggedIn') && $session->get('isLoggedIn')) {
            $currentURI = current_url();
            $loginPageURI = base_url('login');

            // Redirect logged-in users away from the login page
            if ($currentURI === $loginPageURI) {
                return redirect()->to(base_url('/'));
            }
        }
        // Exclude routes that do not require authentication
        $excludedRoutes = ['login', 'register']; // Add routes to exclude
        if (in_array($currentURI, $excludedRoutes)) {
            return;
        }

        // Redirect unauthenticated users to the login page
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'))->with('error', 'Anda harus masuk terlebih dahulu untuk mengakses website ini');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No actions needed after the response
    }
}
