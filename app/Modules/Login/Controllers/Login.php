<?php

namespace App\Modules\Login\Controllers;

use App\Controllers\BaseController;
use App\Modules\Login\Models\LoginModel;

class Login extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new LoginModel();
    }
    public function index()
    {
        $context = [
            'title' => 'Login | ' . parent::$namaToko,
        ];
        return view('layouts/v_login', $context);
    }

    public function submit()
    {
        $payload = $this->request->getPost();

        $validation = \Config\Services::validation();
        $rules = [
            'username_or_email' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'username_or_email' => [
                'required' => 'Username atau email wajib diisi',
            ],
            'password' => [
                'required' => 'Password wajib diisi',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/login')->withInput()->with('errors', $validation->getErrors());
        }

        $userData = $this->model->getPenggunaByUsernameAtauEmail($payload);
        if (!empty($userData) && password_verify($payload['password'], $userData['password'])) {
            if (!((bool) $userData['status'])) {
                session()->setFlashdata('is_negative_response', true);
                session()->setFlashdata('message', "Akun anda non-aktif");
                return redirect()->to('/login')->withInput();
            }
            session()->set([
                'isLoggedIn' => true,
                'userData' => $userData,
            ]);
            return redirect()->to('/');
        } else {
            session()->setFlashdata('is_negative_response', true);
            session()->setFlashdata('message', "Username, email, atau password salah");
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
