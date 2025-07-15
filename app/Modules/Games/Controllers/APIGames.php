<?php

namespace App\Modules\Games\Controllers;

use App\Modules\Games\Models\GamesModel;
use CodeIgniter\RESTful\ResourceController;

class APIGames extends ResourceController
{
    protected $model;
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new GamesModel();
    }

    public function delete($id = null)
    {
        try {
            $db = \Config\Database::connect();
            $result = $db->query('SELECT COUNT(*) as count FROM penjualan p 
                                 JOIN top_up_option tuo ON p.id_top_up_option = tuo.id 
                                 WHERE tuo.id_game = ?', [$id])->getRow();
            $count = $result->count ?? 0;

            if ($count > 0) {
                return $this->respond([
                    'success' => false,
                    'message' => "Game ini memiliki $count transaksi dan tidak dapat dihapus.",
                    'dependencies' => $count
                ], 400);
            }

            return $this->respond($this->model->delete($id), 200);
        } catch (\Throwable $th) {
            return $this->respond([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
