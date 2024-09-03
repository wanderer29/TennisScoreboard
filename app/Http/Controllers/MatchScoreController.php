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

        if (!is_array($match)) {
            $match = json_decode($match, true);
        }

        $winner = $request->input('winner');
        $opponent = $this->getOpponent($winner);


        if ($match['player1']['games'] == 6 && $match['player2']['games'] == 6) { //Time-break logic
            $match[$winner]['points']++;

            if ($match[$winner]['points'] >= 7 && $match[$winner]['points'] - $match[$opponent]['points'] >= 2) {
                $match[$winner]['sets']++;
                $match['player1']['points'] = 0;
                $match['player2']['points'] = 0;
                $match['player1']['games'] = 0;
                $match['player2']['games'] = 0;
            }
        } else { // Points calc logic
            if ($match[$winner]['points'] == 0) {
                $match[$winner]['points'] = 15;
            } elseif ($match[$winner]['points'] == 15) {
                $match[$winner]['points'] = 30;
            } elseif ($match[$winner]['points'] == 30) {
                $match[$winner]['points'] = 40;
            } elseif ($match[$winner]['points'] == 40) {
                if ($match[$opponent]['points'] == 40) {
                    if ($match[$winner]['advantage'] == false) {
                        $match[$winner]['advantage'] = true;
                    } elseif ($match[$winner]['advantage'] == true) {
                        $match[$winner]['games']++;
                        $match[$winner]['points'] = 0;
                        $match[$opponent]['points'] = 0;
                        $match[$winner]['advantage'] = false;
                        $match[$opponent]['advantage'] = false;

                    }
                } else {
                    $match[$winner]['games']++;
                    $match[$winner]['points'] = 0;
                    $match[$opponent]['points'] = 0;
                    $match[$winner]['advantage'] = false;
                    $match[$opponent]['advantage'] = false;
                }
            }
        }

        //Set check
        if ($match[$winner]['games'] >= 6 && $match[$winner]['games'] - $match[$opponent]['games'] >= 2) {
            $match[$winner]['sets']++;
            $match[$winner]['games'] = 0;
            $match[$opponent]['games'] = 0;
        }

        //Finish game test
        if ($match[$winner]['sets'] >= 2) {
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
