<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLogged') === true) return redirect()->to('/dashboard');

        if ($this->request->getMethod() === 'POST') {
            $username = trim((string) $this->request->getPost('username'));
            $password = (string) $this->request->getPost('password');
            if ($username === '' || $password === '') return redirect()->back()->withInput()->with('error', 'Enter both your username and password.');

            $user = (new UserModel())->where('username', $username)->first();
            $valid = $user && (password_verify($password, $user['password']) || hash_equals((string) $user['password'], $password));
            if (! $valid) return redirect()->back()->withInput()->with('error', 'Invalid username or password.');

            session()->regenerate(true);
            session()->set(['isLogged' => true, 'user_id' => $user['id'], 'username' => $user['username']]);
            return redirect()->to('/dashboard');
        }

        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
