<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(string $page = 'Dashboard Admin')
    {
        $modelUser = new UserModel();

        // Using a more concise approach to pass data to the view
        $data = [];

        $data['title'] = ucfirst($page);

        $data['users'] = $modelUser->findAll();

        $data['totalAkun'] = $modelUser->countAll();

        $data['totalAkunByRole'] = $modelUser
            ->select('role, COUNT(*) as count')
            ->groupBy('role')
            ->findAll();

        return view('templates/header', $data)
            . view('admin/dashboard', $data)
            . view('templates/footer');
    }

    public function create(string $page = 'User | Tambah')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        // Set up the data array
        $data = [
            'title' => ucfirst($page),
        ];

        return view('templates/header', $data)
            . view('admin/create', $data)
            . view('templates/footer');
    }

    public function store()
    {
        if ($this->request->getMethod() === 'post' && !$this->validate([
            'csrf_token' => 'required|csrf_token'
        ])) {
            return redirect()->back()->with('error', 'Invalid CSRF token!');
        }

        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role') ?? 'user',
        ];

        if ($model->save($data)) {
            return redirect()->to(base_url('admin_dashboard'))->with('success', 'Data user berhasil disimpan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data user');
    }

    public function edit($id, string $page = 'Users | Edit')
    {
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new UserModel();

        // Fetch the user data by id
        $user = $model->find($id);
        $data = ['user' => $user];
        $data['title'] = ucfirst($page);

        // If user data is not found, show error and redirect
        if (!$user) {
            session()->setFlashdata('error', 'Data user tidak ditemukan.');
            return redirect()->to(base_url('/admin_dashboard'));
        }

        // Add title to the data array
        $data['title'] = ucfirst($page);

        // Return the view with all the data
        return view('templates/header', $data)
            . view('admin/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        // CSRF validation
        if ($this->request->getMethod() === 'post' && !$this->validate([
            'csrf_token' => 'required|csrf_token'
        ])) {
            return redirect()->back()->with('error', 'Invalid CSRF token!');
        }

        // Set CSRF header
        $response = $this->response;
        $response->setHeader('X-CSRF-TOKEN', csrf_hash());

        $model = new UserModel();

        $builder = $this->db->table('users');
        $query = $builder->select('id')
            ->where('id', $id)
            ->limit(1)
            ->get();

        $result = $query->getRow();
        if (!$result) {
            return redirect()->to(base_url('admin_dashboard'))->with('error', 'User tidak ditemukan');
        }

        $updateSuccessful = $model->update($id, [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role') ?? 'user',
        ]);

        // Check if update was successful and pass the appropriate message
        if ($updateSuccessful) {
            return redirect()->to(base_url('admin_dashboard'))->with('success', 'Data user berhasil diupdate');
        } else {
            return redirect()->to(base_url('admin_dashboard'))->with('error', 'Gagal mengupdate data user');
        }
    }

    public function delete($id)
    {
        $model = new UserModel();

        $user = $model->find($id);

        if (!$user) {
            return redirect()->back()->with('error', ' Data user tidak ditemukan');
        }

        // Call the delete logic directly here
        $model->delete($id);

        return redirect()->to(base_url('admin_dashboard'))->with('success', 'Data user berhasil dihapus');
    }

    public function getUsers()
    {
        $model = new UserModel();
        $users = $model->findAll();

        return view('templates/header')
            . view('admin/index', ['users' => $users])
            . view('templates/footer');
    }

    public function maintenance(string $page = 'Maintenance')
    {
        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('pages/maintenance', $data)
            . view('templates/footer');
    }
}
