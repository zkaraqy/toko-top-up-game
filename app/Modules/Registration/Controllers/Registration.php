<?php

namespace App\Modules\Registration\Controllers;

use App\Controllers\BaseController;
use App\Modules\Registration\Models\RegistrationModel;

class Registration extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new RegistrationModel();
    }
    public function index()
    {
        $context = [
            'title' => 'Registrasi | ' . parent::$namaToko,
        ];
        return view('layouts/v_register', $context);
    }

    public function submit()
    {
        $payload = $this->request->getPost();

        $validation = \Config\Services::validation();
        $rules = [
            'nama' => 'required|alpha_space',
            'username' => 'required|is_unique[pengguna.username]|alpha_dash',
            'email' => 'required|is_unique[pengguna.email]|valid_email',
            'password' => 'required'
        ];
        $messages = [
            'nama' => [
                'required' => 'Nama wajib diisi',
                'alpha_space' => 'Nama invalid',
            ],
            'username' => [
                'required' => 'Username wajib diisi',
                'is_unique' => 'Username telah dipakai pengguna lain',
                'alpha_dash' => 'Username invalid',
            ],
            'email' => [
                'required' => 'Email wajib diisi',
                'is_unique' => 'Email telah dipakai pengguna lain',
                'valid_email' => 'Email invalid',
            ],
            'password' => [
                'required' => 'Password wajib diisi',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/register')->withInput()->with('errors', $validation->getErrors());
        }

        $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);

        $userData = $this->model->registrasi($payload);

        if (isset($userData)) {
            session()->setFlashdata('is_negative_response', false);
            session()->setFlashdata('message', "Registrasi berhasil. Silahkan login");
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('is_negative_response', true);
            session()->setFlashdata('message', "Mohon periksa kembali inputan anda");
            return redirect()->to('/register')->withInput();
        }
    }
}
