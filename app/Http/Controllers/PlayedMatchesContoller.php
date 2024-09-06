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
//        $games = Game::with(['getPlayer1Name', 'getPlayer2Name', 'getWinnerName'])->get();
        $games = Game::with(['getPlayer1Name', 'getPlayer2Name', 'getWinnerName'])->paginate(5);

        return view('played_matches_page', compact('games'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $games = Game::whereHas('getPlayer1Name', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%');
        })->orWhereHas('getPlayer2Name', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%');
        })->paginate(5);

        $games->appends(['query' => $query]);

        return view('played_matches_page', ['games' => $games]);
    }
}
