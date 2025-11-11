<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function register()
    {
        return view('auth/register');
    }

    public function storeUser()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role') ?? 'user',
        ];
        $model->insert($data);

        return redirect()->to(base_url('/login'))->with('success', 'Registration successful.');
    }

    public function login()
    {
        $session = session();

        // Check if the user is already logged in
        if ($session->has('isLoggedIn') && $session->get('isLoggedIn')) {
            // Redirect to home page or another suitable page if already logged in
            return redirect()->to(base_url('/'));
        }

        // If not logged in, show the login page
        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        // Get the posted username and password
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Find the user by the posted username
        $user = $model->where('username', $username)->first();

        // Check if the user exists and verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Set session data on successful login
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'nama' => $user['nama'],
                'role' => $user['role'],
                'role2' => $user['role2'],
                'isLoggedIn' => true,
            ]);

            // Redirect to the home page or another page as needed
            return redirect()->to(base_url('/'));
        }

        // If login fails, set an error message and redirect back to the login page
        $session->setFlashdata('error', 'Username atau password salah');

        // Redirect back to login page with error message
        return redirect()->to(base_url('/login'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
