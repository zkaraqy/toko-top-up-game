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
        return $this->respond($this->model->delete($id), 200);
    }
}
