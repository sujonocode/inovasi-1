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

    // public function register()
    // {
    //     $session = session();
    //     $role = $this->request->getPost('role');

    //     // If the user is logged in and their role is 'admin', they can create an admin account
    //     if (session()->get('isLoggedIn') && session()->get('role') == 'admin') {
    //         // Allow 'admin' role in registration
    //         if ($role != 'user' && $role != 'admin') {
    //             return redirect()->back()->with('error', 'Invalid role selection.');
    //         }
    //     } else {
    //         // If the user is not logged in or not an admin, they can only choose 'user'
    //         if ($role != 'user') {
    //             return redirect()->back()->with('error', 'You are not authorized to create an admin account.');
    //         }
    //     }

    //     // Proceed with creating the account
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     $userModel = new UserModel();

    //     // Hash the password before storing
    //     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    //     // Insert new user into the database
    //     $userModel->insert([
    //         'username' => $username,
    //         'password' => $hashedPassword,
    //         'role' => $role,
    //     ]);

    //     return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
    // }

    public function register()
    {
        return view('auth/register');
    }

    public function storeUser()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role') ?? 'user',
        ];
        $model->insert($data);

        return redirect()->to('/login')->with('success', 'Registration successful.');
    }

    public function login()
    {
        return view('auth/login');
    }

    // public function login()
    // {
    //     $session = session();
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     // Get user details from the database (make sure you have a UserModel)
    //     $userModel = new UserModel();
    //     $user = $userModel->where('username', $username)->first();

    //     if ($user && password_verify($password, $user['password'])) {
    //         // Set session data
    //         $session->set([
    //             'isLoggedIn' => true,
    //             'username' => $user['username'],
    //             'role' => $user['role'], // Set the user's role
    //         ]);

    //         return redirect()->to('/dashboard');
    //     } else {
    //         return redirect()->back()->with('error', 'Invalid login credentials.');
    //     }
    // }

    public function authenticate()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->to('/login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
