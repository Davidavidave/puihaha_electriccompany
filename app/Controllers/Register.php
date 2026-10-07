<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function index(): string
    {
        return view('register', [
            'title' => 'Register - Puihaha Electric',
            'page' => 'register',
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
            'validation' => session()->getFlashdata('validation'),
        ]);
    }

    public function create()
    {
        $username = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        if (! $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        if ($userModel->where('username', $username)->first()) {
            return redirect()->back()->withInput()->with('error', 'That email is already registered.');
        }

        $userModel->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful. You can now log in.');
    }
}
