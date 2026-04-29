<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');



            $dataUser = [
                'username' => 'teduh', 
                'password' => '8a980818c1bb2394cd08da056dc79398', 
                'role' => 'admin',
                'email' => '111202416021@mhs.dinus.ac.id',
                'picture' => 'https://img.magnific.com/free-vector/man-profile-account-picture_24908-81754.jpg'
            ]; 

            if ($username == $dataUser['username']) {
                if (md5($password) == $dataUser['password']) {
                    session()->set([
                        'username' => $dataUser['username'],
                        'role' => $dataUser['role'],
                        'email' => $dataUser['email'],
                        'picture' => $dataUser['picture'],
                        'isLoggedIn' => TRUE,
                        'time_when_login' => time()

                    ]);


                    return redirect()->to(base_url('/'));
                } else {
                    
                    session()->setFlashdata('failed', 'Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}