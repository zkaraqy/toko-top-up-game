<?php

namespace App\Modules\Penjualan\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Modules\Penjualan\Models\PenjualanModel;

class APIPenjualan extends ResourceController
{
    protected $model;
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new PenjualanModel();
    }

    public function delete($id = null)
    {
        try {
            return $this->respond($this->model->delete($id), 200);
        } catch (\Throwable $th) {
            return $this->respond(['message' => $th->getMessage(), 'trace' => $th->getTrace()], 500);
        }
    }
}
