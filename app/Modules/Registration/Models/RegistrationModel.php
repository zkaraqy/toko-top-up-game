<?php

namespace App\Modules\Registration\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model {
    protected $table = 'pengguna';

    public function registrasi($payload) {
        $payload['status'] = 1;
        return $this->db->table($this->table)->insert($payload);
    }
}