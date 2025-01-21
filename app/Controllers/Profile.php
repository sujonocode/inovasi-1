<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index(string $page = 'Profile')
    {
        $userModel = new UserModel();
        $user = $userModel->find(session('user_id'));

        $data['title'] = ucfirst($page);

        return view('templates/header', $data)
            . view('profile/index', [
                'title' => 'Profile',
                'user' => $user,
            ])
            . view('templates/footer');
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        $userId = session('user_id');

        // Validate input
        $rules = [
            // 'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update user data
        $userModel->update($userId, [
            // 'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to(base_url('profile'))->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $userModel = new UserModel();
        $userId = session('user_id');

        // Validate input
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check current password
        $user = $userModel->find($userId);
        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update password
        $userModel->update($userId, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to(base_url('profile'))->with('success', 'Password changed successfully.');
    }
}
