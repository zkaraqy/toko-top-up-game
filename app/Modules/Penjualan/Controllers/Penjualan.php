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
                'total_price' => $totalPrice,
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

        $transactions = $this->model->where('id_pengguna', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $context = [
            'title' => 'Riwayat Transaksi | ' . parent::$namaToko,
            'content' => '\App\Modules\Penjualan\Views\v_transaction_history',
            'transactions' => $transactions
        ];

        return view('layouts/v_template_landingpage', $context);
    }

    public function orders()
    {
        return $this->transaction_index();
    }
}
