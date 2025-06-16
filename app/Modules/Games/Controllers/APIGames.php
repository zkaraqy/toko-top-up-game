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
        return $this->respond($this->model->delete($id), 200);
    }
}
