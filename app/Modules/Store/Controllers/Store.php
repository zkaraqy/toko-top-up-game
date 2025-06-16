<?php

namespace App\Modules\Store\Controllers;

use App\Controllers\BaseController;
use App\Modules\Games\Models\GamesModel;
use App\Modules\Games\Models\TopUpOptionModel;

class Store extends BaseController
{

    protected $modelGames;
    protected $topUpModel;

    public function __construct()
    {
        $this->modelGames = new GamesModel();
        $this->topUpModel = new TopUpOptionModel();
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
        // Get all games
        $games = $this->modelGames->select('games.*, COUNT(top_up_option.id) as total_options')
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
        // Get game by slug
        $game = $this->modelGames->where('slug', $slug)->first();

        if (!$game) {
            // Redirect to games page if game not found
            return redirect()->to('/top-up/games')->with('error', 'Game tidak ditemukan');
        }

        // Get top-up options for this game
        $topUpOptions = $this->topUpModel->getByGameId($game['id']);

        $context = [
            'title' => $game['title'] . ' | ' . parent::$namaToko,
            'content' => '\App\Modules\Store\Views\v_landingpage_topup_detail',
            'game' => $game,
            'topUpOptions' => $topUpOptions
        ];
        return view('layouts/v_template_landingpage', $context);
    }
}
