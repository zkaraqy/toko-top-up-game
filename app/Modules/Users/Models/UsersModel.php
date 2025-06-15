<?php

namespace App\Modules\Users\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table = 'pengguna';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'nama', 'email', 'path_foto', 'status', 'is_admin'];
    protected $returnType = 'array';
}
