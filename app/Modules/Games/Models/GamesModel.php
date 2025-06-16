<?php

namespace App\Modules\Games\Models;

use CodeIgniter\Model;

class GamesModel extends Model
{

    protected $table = 'games';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'developer', 'slug', 'path_foto'];
    protected $returnType = 'array';
}
