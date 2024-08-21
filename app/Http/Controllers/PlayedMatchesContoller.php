<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Nette\Utils\Html;

class PlayedMatchesContoller extends Controller
{
    public function index()
    {
//        $games = Game::all();
        $games = Game::with(['getPlayer1Name', 'getPlayer2Name', 'getWinnerName'])->get();

        return view('played_matches_page', compact('games'));
    }
}
