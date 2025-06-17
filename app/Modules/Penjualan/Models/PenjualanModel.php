<?php

namespace App\Modules\Penjualan\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{

    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pengguna', 'id_top_up_option', 'id_metode_pembayaran', 'player_id', 'player_server', 'total_price'];
    protected $returnType = 'array';
}
