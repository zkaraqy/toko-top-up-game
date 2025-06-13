<?php

namespace App\Modules\Store\Controllers;

use App\Controllers\BaseController;
use App\Modules\Store\Models\StoreModel;

class Store extends BaseController {
    public function index() {
        $context = [
            'title' => parent::$namaToko,
            'content' => '\App\Modules\Store\Views\v_landingpage'
        ];
        return view('layouts/v_template_landingpage', $context);
    }
}