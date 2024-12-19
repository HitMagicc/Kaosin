<?php

namespace App\Controllers;

use App\Models\Pemesanan;
use App\Models\User;
use CodeIgniter\HTTP\RedirectResponse;


class LoginController extends BaseController
{
    public function index()
    {
        if (session()->get('is_logged_in')) {
            $level = session()->get('level');
            if ($level == 0) {
                return $this->response->setJSON('GABOLEH'); 
            } elseif ($level == 1) {
                return $this->response->setJSON('GABOLEH');
            }
        }
        return view('login/login');
    }

    public function login()
    {
        $userModel = new User();
        $username = $this->request->getPost('username');
        $user = $userModel->where('username', $username)
        ->orWhere('email', $username)
        ->first();
        $password = $this->request->getPost('password');

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'is_logged_in' => true,
                'level' => $user['level']

            ]);
            $level = session()->get('level');
            if ($level == 0) {
                return redirect()->to('');
            } elseif ($level == 1) {
                return redirect()->to('/admin');
            } else {
                return redirect()->back()->withInput()->with('error', 'Level belum ter-assign');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid username/email or password.');
        }
    }

    public function logout(): RedirectResponse{
        session()->destroy();

        return redirect()->to('')->with('success','You have been logged out');
    }
    public function allUsers()
    {
        $userModel = new Pemesanan();

        $data= $userModel->select('users.*, COUNT(pemesanan.id) as total_pemesanan')
        ->join('users', 'users.id = pemesanan.user_id', 'left')
        ->groupBy('users.id')
        ->get()
        ->getResultArray();
        

        return view('admin/user/index', ['users'=>$data]);
    }
}
