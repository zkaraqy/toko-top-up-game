<?php

namespace App\Modules\Penjualan\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{

    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_pengguna', 'id_top_up_option', 'id_metode_pembayaran', 'player_id', 'player_server', 'price'];
    protected $returnType = 'array';

    public function getPenjualanByUserId($userId)
    {
        return $this->select('
                penjualan.*,
                games.title as game_title,
                games.path_foto as game_image,
                top_up_option.qty as diamond_qty,
                top_up_option.price as diamond_price,
                metode_pembayaran.label as payment_method,
                metode_pembayaran.path_foto as payment_image
            ')
            ->join('top_up_option', 'top_up_option.id = penjualan.id_top_up_option')
            ->join('games', 'games.id = top_up_option.id_game')
            ->join('metode_pembayaran', 'metode_pembayaran.id = penjualan.id_metode_pembayaran')
            ->where('penjualan.id_pengguna', $userId)
            ->orderBy('penjualan.created_at', 'DESC')
            ->findAll();
    }

    public function getAllPenjualanWithDetails($limit = null, $offset = null)
    {
        $builder = $this->select('
                penjualan.*,
                games.title as game_title,
                games.path_foto as game_image,
                top_up_option.qty as diamond_qty,
                top_up_option.price as diamond_price,
                metode_pembayaran.label as payment_method,
                metode_pembayaran.path_foto as payment_image,
                pengguna.name as user_name,
                pengguna.username as username
            ')
            ->join('top_up_option', 'top_up_option.id = penjualan.id_top_up_option')
            ->join('games', 'games.id = top_up_option.id_game')
            ->join('metode_pembayaran', 'metode_pembayaran.id = penjualan.id_metode_pembayaran')
            ->join('pengguna', 'pengguna.id = penjualan.id_pengguna', 'left')
            ->orderBy('penjualan.created_at', 'DESC');

        if ($limit !== null && $offset !== null) {
            $builder->limit($limit, $offset);
        }

        return $builder->findAll();
    }
}
