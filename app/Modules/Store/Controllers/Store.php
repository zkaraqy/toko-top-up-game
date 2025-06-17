<?php

namespace App\Modules\Store\Controllers;

use App\Controllers\BaseController;
use App\Modules\Games\Models\GamesModel;
use App\Modules\Games\Models\TopUpOptionModel;
use App\Modules\PaymentMethod\Models\PaymentMethodModel;

class Store extends BaseController
{
    protected $modelGames;
    protected $topUpModel;
    protected $paymentMethodModel;

    public function __construct()
    {
        $this->modelGames = new GamesModel();
        $this->topUpModel = new TopUpOptionModel();
        $this->paymentMethodModel = new PaymentMethodModel();
    }

    public function index()
    {
        $context = [
            'title' => parent::$namaToko,
            'content' => '\App\Modules\Store\Views\v_landingpage',
            'games' => $this->modelGames->findAll(4),
        ];
        return view('layouts/v_template_landingpage', $context);
    }
    public function showAllGame()
    {
            ->join('top_up_option', 'top_up_option.id_game = games.id', 'left')
            ->groupBy('games.id')
            ->findAll();

        $context = [
            'title' => 'Semua Game | ' . parent::$namaToko,
            'content' => '\App\Modules\Store\Views\v_landingpage_topup',
            'games' => $games
        ];
        return view('layouts/v_template_landingpage', $context);
    }
    public function showDetailGameAndTopUpOption($slug)
    {
        $game = $this->modelGames->where('slug', $slug)->first();

        if (!$game) {
            return redirect()->to('/top-up/games')->with('error', 'Game tidak ditemukan');
        }

        $topUpOptions = $this->topUpModel->getByGameId($game['id']);
        $metodePembayaran = $this->paymentMethodModel->findAll();

        $context = [
            'title' => $game['title'] . ' | ' . parent::$namaToko,
            'content' => '\App\Modules\Store\Views\v_landingpage_topup_detail',
            'game' => $game,
            'topUpOptions' => $topUpOptions,
            'metodePembayaran' => $metodePembayaran
        ];
        return view('layouts/v_template_landingpage', $context);
    }
}
