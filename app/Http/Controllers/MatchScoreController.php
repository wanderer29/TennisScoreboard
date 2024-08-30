<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Mail\Transport\ResendTransport;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MatchScoreController extends Controller
{
    public function index()
    {
        $match = Cache::get('current_match');
    }

    public function store(Request $request) : View
    {
        $match = Cache::get('current_match');

        $match = json_decode($match,true);

        $winner = $request->input('winner');

        $match[$winner]['points']++;

        // Логика для обновления Games и Sets в зависимости от правил тенниса
        if ($match[$winner]['points'] >= 4 && $match[$winner]['points'] - $match[$this->getOpponent($winner)]['points'] >= 2) {
            $match[$winner]['games']++;
            $match[$winner]['points'] = 0;
            $match[$this->getOpponent($winner)]['points'] = 0;
        }

        if ($match[$winner]['games'] >= 6 && $match[$winner]['games'] - $match[$this->getOpponent($winner)]['games'] >= 2) {
            $match[$winner]['sets']++;
            $match[$winner]['games'] = 0;
            $match[$this->getOpponent($winner)]['games'] = 0;
        }

        // Проверяем, закончился ли матч
        if ($match[$winner]['sets'] >= 3) {
            $this->saveMatchToDatabase($match);
            Cache::del('current_match');

            return view('match.final', ['match' => $match]);
        }

        // Сохраняем обновленный матч в Redis
        Cache::set('current_match', json_encode($match));

        return view('match_score_page', ['match' => $match]);
    }

    private function getOpponent($player) : string
    {
        return $player === 'player1' ? 'player2' : 'player1';
    }
}
