<?php

namespace App\Modules\Registration\Controllers;

use App\Controllers\BaseController;
use App\Modules\Registration\Models\RegistrationModel;

class Registration extends BaseController {
    public function index() {
        $context = [
            'title' => 'Registrasi | ' . parent::$namaToko,
        ];
        return view('layouts/v_register', $context);
    }
}