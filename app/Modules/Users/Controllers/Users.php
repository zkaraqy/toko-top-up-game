<?php

namespace App\Modules\Users\Controllers;

use App\Controllers\BaseController;
use App\Modules\Users\Models\UsersModel;

class Users extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UsersModel();
    }

    public function index()
    {
        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\Users\Views\v_users',
            'users' => $this->model->paginate(5, 'bootstrap'),
            'pager' =>  $this->model->pager
        ];
        return view('layouts/v_cms', $context);
    }


    public function detail($id)
    {
        $user = $this->model->find($id);
        if (!isset($user)) {
            return redirect()->to('/admin/users');
        }
        $context = [
            'title' => 'Detail User | ' . parent::$namaToko,
            'content' => '\App\Modules\Users\Views\v_detail_users',
            'user' => $user
        ];
        return view('layouts/v_cms', $context);
    }

    public function form($id = null)
    {
        $context = [
            'title' => ($id ? 'Edit' : 'Tambah') . ' User | ' . parent::$namaToko,
            'validation' => \Config\Services::validation(),
            'content' => '\App\Modules\Users\Views\v_form_users',
        ];

        if ($id) {
            session()->set('is_currently_edit_user', true);
            $user = $this->model->find($id);
            $user['id'] = $id;
            if (!$user) {
                return redirect()->to(base_url('/admin/users'));
            }
            $context['user'] = $user;
        }

        return view('layouts/v_cms', $context);
    }

    public function save()
    {
        $payload = $this->request->getPost();
        $isEdit = isset($payload['id']);
        $flashDataAksi = $isEdit ? 'diedit' : 'ditambahkan';
        try {
            $validation = \Config\Services::validation();
            $rules = [
                'nama' => 'required|alpha_space',
                'username' => 'required|is_unique[pengguna.username]|alpha_dash',
                'email' => 'required|is_unique[pengguna.email]|valid_email',
                'status' => 'required',
                'is_admin' => 'permit_empty',
                'path_foto' => 'max_size[path_foto,2000]|mime_in[path_foto,image/png,image/jpeg,image/gif]'
            ];
            if ($isEdit) {
                $rules['username'] = "required|is_unique[pengguna.username,id,{$payload['id']}]|alpha_dash";
                $rules['email'] = "required|is_unique[pengguna.email,id,{$payload['id']}]|valid_email";
            }
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
                'status' => [
                    'required' => 'Status wajib diisi',
                ],
                'path_foto' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'mime_in' => 'Format foto tidak sesuai',
                ]
            ];
            if (!$isEdit) {
                $rules['password'] = 'required';
                $messages['password'] = [
                    'required' => 'Password wajib diisi',
                ];
            }
            if (!$this->validate($rules, $messages)) {
                return redirect()->to('/admin/users/form' . (isset($payload['id']) ? "/{$payload['id']}" : ''))->withInput()->with('errors', $validation->getErrors());
            }

            $fileFotoRandomName = null;
            $dataToSend = [
                'username' => $payload['username'],
                'nama' => $payload['nama'],
                'email' => $payload['email'],
                'is_admin' => empty($payload['is_admin']) ? 0 : (int) $payload['is_admin'],
                'status' => $payload['status'],
            ];
            if (!$isEdit) {
                $dataToSend['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);
            }
            $fileFoto = $this->request->getFile('path_foto');
            if ($fileFoto?->isFile()) {
                $fileFotoRandomName = $fileFoto?->getRandomName();
                $fileFoto?->move('assets/images/pengguna', $fileFotoRandomName);
                $dataToSend['path_foto'] = $fileFotoRandomName;
            }

            if (isset($payload['id'])) {
                $this->model->update($payload['id'], $dataToSend);
            } else {
                $this->model->insert($dataToSend);
            }
            session()->setFlashdata('is_success', true);
            session()->setFlashdata('title_pesan', "Berhasil $flashDataAksi!");
            session()->setFlashdata('body_pesan', "Data user telah berhasil $flashDataAksi.");
            return redirect()->to(base_url('/admin/users'));
        } catch (\Throwable $th) {
            // var_dump($th->getMessage());
            session()->setFlashdata('is_success', false);
            session()->setFlashdata('title_pesan', "Gagal $flashDataAksi!");
            session()->setFlashdata('body_pesan', "Data user telah gagal $flashDataAksi.");
            return redirect()->to(base_url('/admin/users'));
        }
    }
    public function search()
    {
        $q = $this->request->getGet('q');

        $builder = $this->model;

        if (!empty($q)) {
            $builder = $this->model->groupStart()
                ->like('nama', $q)
                ->orLike('username', $q)
                ->orLike('email', $q)
                ->groupEnd();
        }

        $users = $builder->paginate(5, 'bootstrap');
        $pager = $this->model->pager;

        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\Users\Views\v_users',
            'users' => $users,
            'pager' => $pager,
            'q' => $q
        ];
        return view('layouts/v_cms', $context);
    }
}
