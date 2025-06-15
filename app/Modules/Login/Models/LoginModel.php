<?php

namespace App\Modules\Login\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'pengguna';

    public function getPenggunaByUsernameAtauEmail($payload)
    {
        $userData = $this->db->table($this->table)->select("*")->where([
            'username' => $payload['username_or_email'],
        ])->orWhere([
            'email' => $payload['username_or_email'],
        ])->get()->getRowArray();

        return $userData;
    }
}
