<?php

namespace App\Modules\PaymentMethod\Controllers;

use App\Controllers\BaseController;
use App\Modules\PaymentMethod\Models\PaymentMethodModel;

class PaymentMethod extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PaymentMethodModel();
    }
    public function index()
    {
        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\PaymentMethod\Views\v_paymentmethod',
            'payment_methods' => $this->model->paginate(5, 'bootstrap'),
            'pager' => $this->model->pager
        ];
        return view('layouts/v_cms', $context);
    }

    public function detail($id)
    {
        $payment_method = $this->model->find($id);
        if (!isset($payment_method)) {
            return redirect()->to('/admin/payment-methods');
        }
        $context = [
            'title' => 'Detail Metode Pembayaran | ' . parent::$namaToko,
            'content' => '\App\Modules\PaymentMethod\Views\v_detail_paymentmethod',
            'payment_method' => $payment_method
        ];
        return view('layouts/v_cms', $context);
    }

    public function form($id = null)
    {
        $context = [
            'title' => ($id ? 'Edit' : 'Tambah') . ' Metode Pembayaran | ' . parent::$namaToko,
            'validation' => \Config\Services::validation(),
            'content' => '\App\Modules\PaymentMethod\Views\v_form_paymentmethod',
        ];

        if ($id) {
            session()->set('is_currently_edit_payment_method', true);
            $paymentMethod = $this->model->find($id);
            $paymentMethod['id'] = $id;
            if (!$paymentMethod) {
                return redirect()->to(base_url('/admin/payment-methods'));
            }
            $context['payment_method'] = $paymentMethod;
        }

        return view('layouts/v_cms', $context);
    }

    public function save()
    {
        $payload = $this->request->getPost();
        $isEdit = isset($payload['id']);
        $flashDataAksi = $isEdit ? 'diedit' : 'ditambahkan';
        try {
            $validation = \Config\Services::validation();
            $rules = [
                'kode' => 'required',
                'label' => 'required',
                'path_foto' => 'max_size[path_foto,2000]|mime_in[path_foto,image/png,image/jpeg,image/gif]'
            ];
            $messages = [
                'kode' => [
                    'required' => 'Kode metode pembayaran wajib diisi',
                ],
                'label' => [
                    'required' => 'Label metode pembayaran wajib diisi',
                ],
                'path_foto' => [
                    'max_size' => 'Ukuran foto terlalu besar (maks 2MB)',
                    'mime_in' => 'Format foto tidak valid (JPG, PNG, GIF)'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return redirect()->to('/admin/payment-methods/form' . (isset($payload['id']) ? "/{$payload['id']}" : ''))->withInput()->with('errors', $validation->getErrors());
            }

            $fileFotoRandomName = null;
            $dataToSend = [
                'kode' => $payload['kode'],
                'label' => $payload['label'],
            ];            $fileFoto = $this->request->getFile('path_foto');
            if ($fileFoto?->isFile()) {
                // Create payment methods directory if not exists
                $uploadPath = FCPATH . 'assets/images/payment-methods/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $fileFotoRandomName = $fileFoto?->getRandomName();
                $fileFoto?->move($uploadPath, $fileFotoRandomName);
                $dataToSend['path_foto'] = $fileFotoRandomName;
            }
            

            if (isset($payload['id'])) {
                $this->model->update($payload['id'], $dataToSend);
            } else {
                $this->model->insert($dataToSend);
            }
            session()->setFlashdata('is_success', true);
            session()->setFlashdata('title_pesan', "Berhasil $flashDataAksi!");
            session()->setFlashdata('body_pesan', "Data metode pembayaran telah berhasil $flashDataAksi.");
            return redirect()->to(base_url('/admin/payment-methods'));
        } catch (\Throwable $th) {
            session()->setFlashdata('is_success', false);
            session()->setFlashdata('title_pesan', "Gagal $flashDataAksi!");
            session()->setFlashdata('body_pesan', "Data metode pembayaran gagal $flashDataAksi.");
            return redirect()->to(base_url('/admin/payment-methods'));
        }
    }

    public function search()
    {
        $q = $this->request->getGet('q');

        $builder = $this->model;

        if (!empty($q)) {
            $builder = $this->model->groupStart()
                ->like('kode', $q)
                ->orLike('label', $q)
                ->groupEnd();
        }

        $paymentMethods = $builder->paginate(5, 'bootstrap');
        $pager = $this->model->pager;
        $context = [
            'title' => 'CMS | ' . parent::$namaToko,
            'content' => '\App\Modules\PaymentMethod\Views\v_paymentmethod',
            'payment_methods' => $paymentMethods,
            'pager' => $pager,
            'q' => $q
        ];
        return view('layouts/v_cms', $context);
    }
}
