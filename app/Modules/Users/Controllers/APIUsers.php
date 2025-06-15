<?php

namespace App\Modules\Users\Controllers;

use App\Modules\Users\Models\UsersModel;
use CodeIgniter\RESTful\ResourceController;

class APIUsers extends ResourceController
{
    protected $model;
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new UsersModel();
    }

    public function delete($id = null)
    {
        return $this->respond($this->model->delete($id), 200);
    }

    public function resetPassword()
    {
        $payload = $this->request->getPost();

        try {
            $userId = $payload['id'];
            $user = $this->model->find($userId);

            if (!$user) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ]);
            }

            $newPassword = $this->generateRandomPassword(8);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateResult = $this->model->update($userId, [
                'password' => $hashedPassword,
            ]);

            if ($updateResult) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Password berhasil direset',
                    'new_password' => $newPassword,
                    'username' => $user['username']
                ], 200);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Gagal mengupdate password'
                ], 404);
            }
        } catch (\Throwable $th) {
            return $this->respond([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $th->getMessage()
            ], 500);
        }
    }

    private function generateRandomPassword($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomPassword = '';

        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomPassword;
    }
}
