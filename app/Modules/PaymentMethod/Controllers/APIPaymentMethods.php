<?php

namespace App\Modules\PaymentMethod\Controllers;

use App\Modules\PaymentMethod\Models\PaymentMethodModel;
use CodeIgniter\RESTful\ResourceController;

class APIPaymentMethods extends ResourceController
{
    protected $model;
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new PaymentMethodModel();
    }

    public function delete($id = null)
    {
        try {
            $penjualanModel = new \App\Modules\Penjualan\Models\PenjualanModel();
            $count = $penjualanModel->where('id_metode_pembayaran', $id)->countAllResults();
            
            if ($count > 0) {
                return $this->respond([
                    'success' => false,
                    'message' => "Metode pembayaran ini digunakan dalam $count transaksi dan tidak dapat dihapus.",
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
