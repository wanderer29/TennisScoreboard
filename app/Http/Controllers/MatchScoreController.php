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

    public function store(Request $request): View
    {
        $match = Cache::get('current_match');

        if (!is_array($match)){
            $match = json_decode($match, true);
        }

        $winner = $request->input('winner');

        $match[$winner]['points']++;

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

        if ($match[$winner]['sets'] >= 3) {
            $this->saveMatchToDatabase($match, $winner);
            Cache::forget('current_match');

            return view('home_page');
        }

        Cache::set('current_match', json_encode($match));

        return view('match_score_page', ['match' => $match]);
    }

    private function getOpponent($player): string
    {
        return $player == 'player1' ? 'player2' : 'player1';
    }

    private function saveMatchToDatabase(array $match, string $winner): void
    {
        $player1ID = $this->getPlayerID($match['player1']['name']);
        $player2ID = $this->getPlayerID($match['player2']['name']);
        $winnerID = $this->getPlayerID($match[$winner]['name']);

        Game::create([
            'player1' => $player1ID,
            'player2' => $player2ID,
            'winner' => $winnerID,
        ]);
    }

    private function getPlayerID(string $playerName): int
    {
        $player = Player::where('name', $playerName)->first();

        if (!$player) {
            $player = Player::create(['name' => $playerName]);
        }

        return $player->id;
    }
}
