<?php

namespace App\Http\Controllers;


use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Nette\Utils\Html;

class NewMatchController extends Controller
{
    public function create(): View
    {
        return view('new_match_page');
    }

    public function store(): View
    {
        $data = request()->validate([
            'name1' => 'string',
            'name2' => 'string',
        ]);

        if ($data['name1'] == $data['name2']) {
            echo "Names must be different";
            return view('new_match_page');
        } else {
            $currentMatch = [
                'player1' => $data['name1'],
                'player2' => $data['name2'],
                'scorePlayer1' => 0,
                'scorePlayer2' => 0,
            ];

            Cache::put('current_match', $currentMatch);


            return view('match_score_page');
        }
    }

    public function isPlayerExsits(Player $player): bool
    {
        $players = Player::all();
        if ($players->contains($player)) {
            return true;
        }
        return false;
    }


    public function createGame(int $player1ID, int $player2ID, int $winnerID): null
    {
        Game::create([
            'player1' => $player1ID,
            'player2' => $player2ID,
            'winner' => $winnerID,
        ]);
        dd('created');
    }

    public function createPlayer(string $name): void
    {
        Player::create(['name' => $name]);
    }
}
