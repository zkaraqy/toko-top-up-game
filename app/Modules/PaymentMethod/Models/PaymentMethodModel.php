<?php

namespace App\Modules\PaymentMethod\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'label', 'path_foto'];
    protected $returnType = 'array';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
