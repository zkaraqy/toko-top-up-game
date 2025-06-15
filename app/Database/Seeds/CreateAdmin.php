<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class CreateAdmin extends Seeder
{
    public function run()
    {
        $adminData = [
            'username'          => 'admin',
            'password'          => password_hash('12345678', PASSWORD_DEFAULT),
            'nama'              => 'Administrator Utama',
            'email'             => 'admin@gmail.com',
            'path_foto'         => null,
            'status'            => true,
            'is_admin'          => true,
            'created_at'        => Time::now()->toDateTimeString(),
            'updated_at'        => Time::now()->toDateTimeString(),
        ];

        $alreadyInserted = $this->db->table('pengguna')->where(['username' => $adminData['username']])->countAllResults();
        if ($alreadyInserted === 0) {
            $this->db->table('pengguna')->insert($adminData);
        } else {
            $this->db->table('pengguna')->where(['username' => $adminData['username']])->update($adminData);
        }
    }
}
