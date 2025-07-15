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
    
    public function checkDependencies()
    {
        $payload = $this->request->getPost();
        $entityType = $payload['entity_type'] ?? ''; 
        $entityId = $payload['entity_id'] ?? 0;

        if (empty($entityType) || empty($entityId)) {
            return $this->respond([
                'success' => false,
                'message' => 'Parameter tidak lengkap',
                'is_used' => false
            ], 400);
        }

        $isUsed = false;
        $message = '';

        try {
            switch ($entityType) {
                case 'user':
                    $count = $this->model->where('id_pengguna', $entityId)->countAllResults();
                    $isUsed = ($count > 0);
                    $message = $isUsed ? 'User ini memiliki ' . $count . ' transaksi dan tidak dapat dihapus.' : 'User dapat dihapus.';
                    break;
                
                case 'game':
                    $db = \Config\Database::connect();
                    $result = $db->query('SELECT COUNT(*) as count FROM penjualan p 
                                          JOIN top_up_option tuo ON p.id_top_up_option = tuo.id 
                                          WHERE tuo.id_game = ?', [$entityId])->getRow();
                    $count = $result->count ?? 0;
                    $isUsed = ($count > 0);
                    $message = $isUsed ? 'Game ini memiliki ' . $count . ' transaksi dan tidak dapat dihapus.' : 'Game dapat dihapus.';
                    break;
                
                case 'payment_method':
                    $count = $this->model->where('id_metode_pembayaran', $entityId)->countAllResults();
                    $isUsed = ($count > 0);
                    $message = $isUsed ? 'Metode pembayaran ini digunakan dalam ' . $count . ' transaksi dan tidak dapat dihapus.' : 'Metode pembayaran dapat dihapus.';
                    break;
                
                default:
                    return $this->respond([
                        'success' => false,
                        'message' => 'Tipe entitas tidak valid',
                        'is_used' => false
                    ], 400);
            }

            return $this->respond([
                'success' => true,
                'message' => $message,
                'is_used' => $isUsed,
                'count' => $count
            ], 200);

        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'is_used' => false
            ], 500);
        }
    }
}
