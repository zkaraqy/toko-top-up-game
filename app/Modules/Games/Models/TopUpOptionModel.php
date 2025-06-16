<?php

namespace App\Modules\Games\Models;

use CodeIgniter\Model;

class TopUpOptionModel extends Model
{
    protected $table = 'top_up_option';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_game', 'qty', 'price', 'path_foto'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getByGameId($gameId)
    {
        return $this->where('id_game', $gameId)->findAll();
    }

    public function deleteByGameId($gameId)
    {
        return $this->where('id_game', $gameId)->delete();
    }
}
