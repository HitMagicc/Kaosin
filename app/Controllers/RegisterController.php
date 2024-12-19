<?php

namespace App\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;

class RegisterController extends BaseController
{
    public function index()
    {
        // Tampilkan halaman register
        return view('login/register');
    }

    public function register()
    {
        $userModel = new User();
        $id = Uuid::uuid4()->toString();

        $password = $this->request->getPost('password');
    
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'    => 'required|valid_email|max_length[100]|is_unique[users.email]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->listErrors());
        }

        $data = [
            'id' => $id,
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => 0,
        ];
        if ($userModel->save($data)) {
        return redirect()->to('/login')->with('success', 'Registration successful');
    } else {
        return redirect()->back()->withInput()->with('error', 'An error occurred while registering. Please try again.');
    }
    }
}
