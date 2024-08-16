<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;

class MatchScoreController extends Controller
{
    public function index()
    {
        $player = Player::all();
//        dump($player);
        return view('new_match_page');
    }
}
