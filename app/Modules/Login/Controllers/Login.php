<?php

namespace App\Modules\Login\Controllers;

use App\Controllers\BaseController;
use App\Modules\Login\Models\LoginModel;

class Login extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new LoginModel();
    }
    public function index() {
        $context = [
            'title' => 'Login | ' . parent::$namaToko,
        ];
        return view('layouts/v_login', $context);
    }
}