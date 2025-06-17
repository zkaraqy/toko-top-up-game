<?php

namespace App\Modules\Games\Controllers;

use App\Controllers\BaseController;
use App\Modules\Games\Models\GamesModel;
use App\Modules\Games\Models\TopUpOptionModel;

class Games extends BaseController
{
    protected $model;
    protected $topUpModel;
    public function __construct()
    {
        $this->model = new GamesModel();
        $this->topUpModel = new TopUpOptionModel();
        helper('slug');
    }

    public function index()
    {
        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\Games\Views\v_games',
            'games' => $this->model->paginate(5, 'bootstrap'),
            'pager' =>  $this->model->pager
        ];
        return view('layouts/v_cms', $context);
    }


    public function detail($id)
    {
        $game = $this->model->find($id);
        if (!isset($game)) {
            return redirect()->to('/admin/games');
        }
        $context = [
            'title' => 'Detail Game | ' . parent::$namaToko,
            'content' => '\App\Modules\Games\Views\v_detail_game',
            'game' => $game,
            'topUpOptions' => $this->topUpModel->getByGameId($id)
        ];
        return view('layouts/v_cms', $context);
    }

    public function form($id = null)
    {
        $context = [
            'title' => ($id ? 'Edit' : 'Tambah') . ' Game | ' . parent::$namaToko,
            'validation' => \Config\Services::validation(),
            'content' => '\App\Modules\Games\Views\v_form_game',
        ];

        if ($id) {
            session()->set('is_currently_edit_game', true);
            $game = $this->model->find($id);
            $game['id'] = $id;
            if (!$game) {
                return redirect()->to(base_url('/admin/games'));
            }
            $context['game'] = $game;
            $context['topUpOptions'] = $this->topUpModel->getByGameId($id);
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
                'title' => 'required',
                'developer' => 'required',
                'path_foto' => 'max_size[path_foto,2000]|mime_in[path_foto,image/png,image/jpeg,image/gif]'
            ];
            $messages = [
                'title' => [
                    'required' => 'Judul wajib diisi',
                ],
                'developer' => [
                    'required' => 'Nama developer wajib diisi',
                ],
                'path_foto' => [
                    'max_size' => 'Ukuran foto terlalu besar',
                    'mime_in' => 'Format foto tidak sesuai',
                ]
            ];
            if (!$this->validate($rules, $messages)) {
                return redirect()->to('/admin/games/form' . (isset($payload['id']) ? "/{$payload['id']}" : ''))->withInput()->with('errors', $validation->getErrors());
            }

            $slug = generateUniqueSlug($payload['title'], $this->model, $payload['id'] ?? null);

            $fileFotoRandomName = null;
            $dataToSend = [
                'title' => $payload['title'],
                'developer' => $payload['developer'],
                'slug' => $slug
            ];
            $fileFoto = $this->request->getFile('path_foto');
            if ($fileFoto?->isFile()) {
                $fileFotoRandomName = $fileFoto?->getRandomName();
                $fileFoto?->move('assets/images/games', $fileFotoRandomName);
                $dataToSend['path_foto'] = $fileFotoRandomName;
            }

            if (isset($payload['id'])) {
                $this->model->update($payload['id'], $dataToSend);
            } else {
                $this->model->insert($dataToSend);
            }
            session()->setFlashdata('is_success', true);
            session()->setFlashdata('title_pesan', "Berhasil $flashDataAksi!");
            session()->setFlashdata('body_pesan', "Data game telah berhasil $flashDataAksi.");
            return redirect()->to(base_url('/admin/games'));
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            // session()->setFlashdata('is_success', false);
            // session()->setFlashdata('title_pesan', "Gagal $flashDataAksi!");
            // session()->setFlashdata('body_pesan', "Data game telah gagal $flashDataAksi.");
            // return redirect()->to(base_url('/admin/games'));
        }
    }
    public function search()
    {
        $q = $this->request->getGet('q');

        $builder = $this->model;

        if (!empty($q)) {
            $builder = $this->model->groupStart()
                ->like('title', $q)
                ->orLike('developer', $q)
                ->groupEnd();
        }

        $games = $builder->paginate(5, 'bootstrap');
        $pager = $this->model->pager;

        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\Games\Views\v_games',
            'games' => $games,
            'pager' => $pager,
            'q' => $q
        ];
        return view('layouts/v_cms', $context);
    }

    public function saveTopUpOption()
    {
        try {
            $payload = $this->request->getPost();

            $validation = \Config\Services::validation();
            $rules = [
                'game_id' => 'required|integer',
                'qty' => 'required|integer|greater_than[0]',
                'price' => 'required|integer|greater_than[0]',
                'path_foto' => 'max_size[path_foto,2000]|mime_in[path_foto,image/png,image/jpeg,image/gif]'
            ];
            $messages = [
                'game_id' => [
                    'required' => 'Game ID wajib diisi',
                    'integer' => 'Game ID harus berupa angka'
                ],
                'qty' => [
                    'required' => 'Kuantitas wajib diisi',
                    'integer' => 'Kuantitas harus berupa angka',
                    'greater_than' => 'Kuantitas harus lebih dari 0'
                ],
                'price' => [
                    'required' => 'Harga wajib diisi',
                    'integer' => 'Harga harus berupa angka',
                    'greater_than' => 'Harga harus lebih dari 0'
                ],
                'path_foto' => [
                    'max_size' => 'Ukuran foto terlalu besar (maks 2MB)',
                    'mime_in' => 'Format foto tidak valid (JPG, PNG, GIF)'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $validation->getErrors()
                ]);
            }
            $dataToSend = [
                'id_game' => $payload['game_id'],
                'qty' => $payload['qty'],
                'price' => $payload['price']
            ];

            $fileFoto = $this->request->getFile('path_foto');
            if ($fileFoto && $fileFoto->isFile()) {
                if (!is_dir('assets/images/topup/')) {
                    mkdir('assets/images/topup/', 0755, true);
                }

                $fileFotoRandomName = $fileFoto->getRandomName();
                $fileFoto->move('assets/images/topup', $fileFotoRandomName);
                $dataToSend['path_foto'] = $fileFotoRandomName;
            }

            $this->topUpModel->insert($dataToSend);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Top-up option berhasil ditambahkan'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ]);
        }
    }

    public function updateTopUpOption($id)
    {
        try {
            $payload = $this->request->getPost();

            $existingOption = $this->topUpModel->find($id);
            if (!$existingOption) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Top-up option tidak ditemukan'
                ]);
            }

            $validation = \Config\Services::validation();
            $rules = [
                'qty' => 'required|integer|greater_than[0]',
                'price' => 'required|integer|greater_than[0]',
                'path_foto' => 'max_size[path_foto,2000]|mime_in[path_foto,image/png,image/jpeg,image/gif]'
            ];
            $messages = [
                'qty' => [
                    'required' => 'Kuantitas wajib diisi',
                    'integer' => 'Kuantitas harus berupa angka',
                    'greater_than' => 'Kuantitas harus lebih dari 0'
                ],
                'price' => [
                    'required' => 'Harga wajib diisi',
                    'integer' => 'Harga harus berupa angka',
                    'greater_than' => 'Harga harus lebih dari 0'
                ],
                'path_foto' => [
                    'max_size' => 'Ukuran foto terlalu besar (maks 2MB)',
                    'mime_in' => 'Format foto tidak valid (JPG, PNG, GIF)'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $validation->getErrors()
                ]);
            }

            $dataToSend = [
                'qty' => $payload['qty'],
                'price' => $payload['price']
            ];

            $fileFoto = $this->request->getFile('path_foto');
            if ($fileFoto && $fileFoto->isFile()) {
                $fileFotoRandomName = $fileFoto->getRandomName();
                $fileFoto->move('assets/images/topup', $fileFotoRandomName);
                $dataToSend['path_foto'] = $fileFotoRandomName;
            }

            $this->topUpModel->update($id, $dataToSend);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Top-up option berhasil diperbarui'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ]);
        }
    }

    public function deleteTopUpOption($id)
    {
        try {
            $existingOption = $this->topUpModel->find($id);
            if (!$existingOption) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Top-up option tidak ditemukan'
                ]);
            }

            if (!empty($existingOption['path_foto']) && file_exists('assets/images/topup/' . $existingOption['path_foto'])) {
                unlink('assets/images/topup/' . $existingOption['path_foto']);
            }

            $this->topUpModel->delete($id);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Top-up option berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ]);
        }
    }
}
