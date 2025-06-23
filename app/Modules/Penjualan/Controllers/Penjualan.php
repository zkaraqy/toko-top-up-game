<?php

namespace App\Modules\Penjualan\Controllers;

use App\Controllers\BaseController;
use App\Modules\Penjualan\Models\PenjualanModel;
use App\Modules\Games\Models\TopUpOptionModel;
use App\Modules\PaymentMethod\Models\PaymentMethodModel;

class Penjualan extends BaseController
{
    protected $model;
    protected $topUpOptionModel;
    protected $paymentMethodModel;

    public function __construct()
    {
        $this->model = new PenjualanModel();
        $this->topUpOptionModel = new TopUpOptionModel();
        $this->paymentMethodModel = new PaymentMethodModel();
    }

    public function transaction()
    {
        $payload = $this->request->getPost();

        try {
            $validation = \Config\Services::validation();
            $rules = [
                'id_top_up_option' => 'required|numeric',
                'id_metode_pembayaran' => 'required|numeric',
                'player_id' => 'required|numeric',
                'player_server' => 'required|numeric|greater_than[0]',
            ];

            $messages = [
                'id_top_up_option' => [
                    'required' => 'Opsi top-up wajib dipilih',
                    'numeric' => 'Opsi top-up tidak valid',
                ],
                'id_metode_pembayaran' => [
                    'required' => 'Metode pembayaran wajib dipilih',
                    'numeric' => 'Metode pembayaran tidak valid',
                ],
                'player_id' => [
                    'required' => 'Player ID wajib diisi',
                    'numeric' => 'Player ID hanya boleh berisi angka',
                ],
                'player_server' => [
                    'required' => 'Server wajib diisi',
                    'numeric' => 'Server harus berupa angka',
                    'greater_than' => 'Server harus lebih dari 0'
                ],
            ];

            if (!$this->validate($rules, $messages)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $topUpOption = $this->topUpOptionModel->find($payload['id_top_up_option']);

            $totalPrice = $topUpOption['price'];

            $dataToSend = [
                'id_pengguna' => session()->get('userData')['id'],
                'id_top_up_option' => $payload['id_top_up_option'],
                'id_metode_pembayaran' => $payload['id_metode_pembayaran'],
                'player_id' => $payload['player_id'],
                'player_server' => $payload['player_server'],
                'price' => $totalPrice,
            ];

            $transactionId = $this->model->insert($dataToSend);

            if ($transactionId) {
                session()->setFlashdata('is_success', true);
                session()->setFlashdata('title_pesan', 'Pesanan Berhasil!');
                session()->setFlashdata('body_pesan', "Pesanan Anda telah berhasil dibuat dengan ID: #$transactionId. Total pembayaran: Rp " . number_format($totalPrice, 0, ',', '.'));

                return redirect()->back();
            } else {
                throw new \Exception('Gagal menyimpan data transaksi');
            }
        } catch (\Throwable $th) {
            log_message('error', 'Transaction Error: ' . $th->getMessage());
            session()->setFlashdata('is_success', false);
            session()->setFlashdata('title_pesan', 'Gagal Memproses Pesanan!');
            session()->setFlashdata('body_pesan', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function transaction_index()
    {
        $userId = session()->get('userData')['id'];

        $transactions = $this->model->select('penjualan.*, top_up_option.qty AS qty, games.title AS nama_game, metode_pembayaran.kode AS metode_pembayaran_kode, metode_pembayaran.label AS metode_pembayaran_label')
            ->where('penjualan.id_pengguna', $userId)
            ->join('top_up_option', 'penjualan.id_top_up_option = top_up_option.id')
            ->join('games', 'top_up_option.id_game = games.id')
            ->join('metode_pembayaran', 'metode_pembayaran.id = penjualan.id_metode_pembayaran')
            ->orderBy('penjualan.created_at', 'DESC')
            ->findAll();

        $context = [
            'title' => 'Riwayat Transaksi | ' . parent::$namaToko,
            'content' => '\App\Modules\Penjualan\Views\v_riwayat_transaksi',
            'transactions' => $transactions
        ];

        return view('layouts/v_template_landingpage', $context);
    }

    public function sales()
    {
        $context = [
            'title' => 'Penjualan | ' . parent::$namaToko,
            'content' => '\App\Modules\Penjualan\Views\admin\v_penjualan',
            'sales' => $this->model->select(
                '
                penjualan.*, 
                pengguna.id AS id_pengguna, 
                pengguna.nama AS nama_pengguna, 
                pengguna.username AS username_pengguna, 
                top_up_option.qty AS qty, 
                games.title AS nama_game, 
                games.id AS id_game, 
                metode_pembayaran.id AS metode_pembayaran_id, 
                metode_pembayaran.kode AS metode_pembayaran_kode, 
                metode_pembayaran.label AS metode_pembayaran_label'
            )
                ->join('pengguna', 'pengguna.id = penjualan.id_pengguna', 'inner')
                ->join('top_up_option', 'penjualan.id_top_up_option = top_up_option.id')
                ->join('games', 'top_up_option.id_game = games.id')
                ->join('metode_pembayaran', 'metode_pembayaran.id = penjualan.id_metode_pembayaran')
                ->paginate(5, 'bootstrap'),
            'pager' =>  $this->model->pager
        ];

        return view('layouts/v_cms', $context);
    }

    public function search()
    {
        $q = $this->request->getGet('q');

        $builder = $this->model;

        if (!empty($q)) {
            $builder = $this->model->select(
                '
                penjualan.*, 
                pengguna.id AS id_pengguna, 
                pengguna.nama AS nama_pengguna, 
                pengguna.username AS username_pengguna, 
                top_up_option.qty AS qty, 
                games.title AS nama_game, 
                games.id AS id_game, 
                metode_pembayaran.id AS metode_pembayaran_id, 
                metode_pembayaran.kode AS metode_pembayaran_kode, 
                metode_pembayaran.label AS metode_pembayaran_label'
            )
                ->join('pengguna', 'pengguna.id = penjualan.id_pengguna', 'inner')
                ->join('top_up_option', 'penjualan.id_top_up_option = top_up_option.id')
                ->join('games', 'top_up_option.id_game = games.id')
                ->join('metode_pembayaran', 'metode_pembayaran.id = penjualan.id_metode_pembayaran')
                ->groupStart()
                ->like('pengguna.nama', $q)
                ->orLike('pengguna.username', $q)
                ->orLike('games.title', $q)
                ->orLike('metode_pembayaran.kode', $q)
                ->orLike('metode_pembayaran.label', $q)
                ->orLike('penjualan.price', $q)
                ->orLike('top_up_option.qty', $q)
                ->groupEnd();
        } else {
            $builder = $this->model->select(
                '
                penjualan.*, 
                pengguna.id AS id_pengguna, 
                pengguna.nama AS nama_pengguna, 
                pengguna.username AS username_pengguna, 
                top_up_option.qty AS qty, 
                games.title AS nama_game, 
                games.id AS id_game, 
                metode_pembayaran.id AS metode_pembayaran_id, 
                metode_pembayaran.kode AS metode_pembayaran_kode, 
                metode_pembayaran.label AS metode_pembayaran_label'
            )
                ->join('pengguna', 'pengguna.id = penjualan.id_pengguna', 'inner')
                ->join('top_up_option', 'penjualan.id_top_up_option = top_up_option.id')
                ->join('games', 'top_up_option.id_game = games.id')
                ->join('metode_pembayaran', 'metode_pembayaran.id = penjualan.id_metode_pembayaran');
        }

        $sales = $builder->paginate(5, 'bootstrap');
        $pager = $this->model->pager;

        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\Penjualan\Views\admin\v_penjualan',
            'sales' => $sales,
            'pager' => $pager,
            'q' => $q
        ];
        return view('layouts/v_cms', $context);
    }
}
